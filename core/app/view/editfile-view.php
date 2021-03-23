<?php 
$file = FileData::getById($_GET["id"]);
$p = PacientData::getById($file->pacient_id);
?>
<section class="content">
<?php
$categories = DoctypeData::getAll();
?>
<div class="row">
	<div class="col-md-12">
    <h1><?php echo $p->name." ".$p->lastname; ?> <small>Editar archivo</small></h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" enctype="multipart/form-data" action="index.php?action=files&opt=update" role="form">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Titulo*</label>
    <div class="col-md-6">
      <input type="text" name="title" value="<?php echo $file->title; ?>" required class="form-control" id="name" placeholder="Titulo">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Archivo*</label>
    <div class="col-md-6">
      <input type="file" name="name">
      <p class="text-muted">* Seleccionar un archivo para sustituir el anterior.</p>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo*</label>
    <div class="col-md-6">
    <select name="doctype_id" required class="form-control">
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($categories as $cat):?>
    <option value="<?php echo $cat->id; ?>" <?php if($file->doctype_id==$cat->id){ echo "selected"; }?>><?php echo $cat->name; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion*</label>
    <div class="col-md-6">
      <textarea name="description"  class="form-control" placeholder="Descripcion"><?php echo $file->description; ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="id" value="<?php echo $file->id; ?>">
      <button type="submit" class="btn btn-success">Actualizar Archivo</button>
    </div>
  </div>
</form>
	</div>
</div>
</section>