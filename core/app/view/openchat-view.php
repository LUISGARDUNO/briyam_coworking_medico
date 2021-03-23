<?php
$msgs = MsgData::getAllByPM($_SESSION["pacient_id"], $_GET["medic_id"]);
$medic= MedicData::getById($_GET["medic_id"]);
$pacient = PacientData::getById($_SESSION["pacient_id"]);
 ?>
<section class="content">
<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
</div>
		<h1>Mis Mensajes con el medico <?php echo $medic->name." ".$medic->lastname; ?></h1>
<br>

<!-- DIRECT CHAT -->
              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title"> Chat</h3>


                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages" style="height: 500px; ">
                    <!-- Message. Default to the left -->
                    <?php foreach($msgs as $msg):
//$pacient= PacientData::getById($msg->pacient_id);
//$medic = MedicData::getById($msg->medic_id);
                    	?>
                    	<?php if($msg->kind==1):?>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"><?php echo $pacient->name." ".$pacient->lastname; ?></span>
                        <span class="direct-chat-timestamp pull-right"><?php echo $msg->created_at; ?></span>
                      </div>
                      <!-- /.direct-chat-info 
                      <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
             /.direct-chat-img -->
                      <div class="direct-chat-text">
                      	<?php echo $msg->content; ?>
                      	<?php if($msg->file!=""):?>
                      		<div><a href="./storage/files/<?php echo $msg->file; ?>" target="_blank"><?php echo $msg->file; ?></a>
                      	<?php endif; ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <?php elseif($msg->kind==2):?>
                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-right"><?php echo $medic->name." ".$medic->lastname; ?></span>
                        <span class="direct-chat-timestamp pull-left"><?php echo $msg->created_at; ?></span>
                      </div>
                      <!-- /.direct-chat-info 
                      <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
           /.direct-chat-img -->
                      <div class="direct-chat-text">
 	<?php echo $msg->content; ?>
                      	<?php if($msg->file!=""):?>
                      		<div><a href="./storage/files/<?php echo $msg->file; ?>" target="_blank"><?php echo $msg->file; ?></a>
                      	<?php endif; ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                <?php endif; ?>
                <?php endforeach ; ?>
                    <!-- /.direct-chat-msg -->
                  </div>
                  <!--/.direct-chat-messages-->

                  <!-- Contacts are loaded here -->
                  <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <form action="./?action=send1" enctype="multipart/form-data" method="post">
                  	<input type="hidden" name="medic_id" value="<?php echo $_GET["medic_id"];?>">
                  	<div class="form-group">
                      <input type="file" name="file" placeholder="Archivo ..." >
                </div>
                    <div class="input-group">
                      <input type="text" name="content" autofocus placeholder="Mensaje ..." class="form-control">
                      <span class="input-group-btn">
                            <button type="submit" class="btn btn-info btn-flat">Enviar</button>
                          </span>
                    </div>
                  </form>
                </div>
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->



<script type="text/javascript">
	$('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);

</script>


	</div>
</div>
</section>