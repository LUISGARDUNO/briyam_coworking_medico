<!DOCTYPE html>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- #include file ="adovbs.inc" -->
<!-- #include file="function/config.asp" -->
<!-- #include file="function/function.asp" -->
<!-- #include file="function/seguridad.asp" -->

<html lang="es" class=" ">
<head>
	<meta
			name="viewport"
			content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
		/>
		<link
			rel="shortcut icon"
			href="img/iconoLOGOBmedical.ico"
			type="img/iconoLOGOBmedical.ico"
		/>
</head>
<center>
<body link="#000080" vlink="#000080" text="#000000">
<form name="forma" method="post" action="calendar.asp" class="content">
<script>

function actualizar(){location.reload(true);}
//Función para actualizar cada 4 segundos(4000 milisegundos)
  setInterval("actualizar()",90000);

function movcalendar(fecha1)
	{
	document.forma.t_fecha.value=fecha1;
	document.forma.submit();
	}

function terminar(t_usuario)
	{
	var opcion = confirm("¿ Continuar con las reservaciones realizadas ?");
    if (opcion == true) {
		tipo = 'sessiontermina.asp?t_usuario='+t_usuario;
		window.open(tipo,'_parent','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=150,height=150,left=600,top=200');
		}
	}

function limpiar(fecha,t_usuario,t_mov)
	{
	var opcion = confirm("¿ Esta seguro de cancelar todas las reservaciones realizadas ?");
    if (opcion == true) {
		tipo = 'atn.asp?fecha='+fecha+'&t_consu=0&t_fecha=&t_hora=&t_usuario='+t_usuario+'&t_mov='+t_mov+'&t_consulta=<%=cdbl(request.form("t_consulta"))%>&consultorio=<%=cdbl(request.form("t_consu"))%>';
		window.open(tipo,'','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=150,height=150,left=600,top=200');
		}
	}

function cancelatodo(fecha,t_usuario,t_mov)
	{
	var opcion = confirm("¿ Esta seguro de salir y cancelar todas las reservaciones realizadas ?");
    if (opcion == true) {
		tipo = 'atn.asp?fecha='+fecha+'&t_consu=0&t_fecha=&t_hora=&t_usuario='+t_usuario+'&t_mov='+t_mov+'&t_consulta=<%=cdbl(request.form("t_consulta"))%>&consultorio=<%=cdbl(request.form("t_consu"))%>';
		window.open(tipo,'','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=150,height=150,left=600,top=200');
		}
	}

function cancela2(fecha,t_consu,t_fecha,t_hora,t_usuario,t_mov)
	{
	var opcion = confirm("¿ Esta seguro de cancelar la reservación de Consultorio "+t_consu+" del día "+t_fecha+" a las "+t_hora+":00 horas ?");
    if (opcion == true) {
		tipo = 'atn.asp?fecha='+fecha+'&t_consu='+t_consu+'&t_fecha='+t_fecha+'&t_hora='+t_hora+'&t_usuario='+t_usuario+'&t_mov='+t_mov+'&t_consulta=<%=cdbl(request.form("t_consulta"))%>&consultorio=<%=cdbl(request.form("t_consu"))%>';
		window.open(tipo,'','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=150,height=150,left=600,top=200');
		}
	}

function cancela(fecha,t_consu,t_fecha,t_hora,t_usuario,t_mov)
	{
	/**var opcion = confirm("¿ Seguro de cancelar reservación ?");
    if (opcion == true) {**/
		tipo = 'atn.asp?fecha='+fecha+'&t_consu='+t_consu+'&t_fecha='+t_fecha+'&t_hora='+t_hora+'&t_usuario='+t_usuario+'&t_mov='+t_mov+'&t_consulta=<%=cdbl(request.form("t_consulta"))%>&consultorio=<%=cdbl(request.form("t_consu"))%>';
		window.open(tipo,'','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=150,height=150,left=600,top=200');
		/**}**/
	}

function reserva(fecha,t_consu,t_fecha,t_hora,t_usuario,t_mov)
	{
	/**var opcion = confirm("¿ Confirmar reservación ?");
    if (opcion == true) {**/
		tipo = 'atn.asp?fecha='+fecha+'&t_consu='+t_consu+'&t_fecha='+t_fecha+'&t_hora='+t_hora+'&t_usuario='+t_usuario+'&t_mov='+t_mov+'&t_consulta=<%=cdbl(request.form("t_consulta"))%>&consultorio=<%=cdbl(request.form("t_consu"))%>';
		window.open(tipo,'','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=10,height=10,left=600,top=200');
		/**}**/
	}
</script>

<link rel="stylesheet" href="shadowbox/shadowbox.css">
<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
<script  src="shadowbox/shadowbox.js"></script>

<script type='text/javascript'>
	 Shadowbox.init({
	 overlayColor: "#0070C0",
	 flashParams:  "#FFFFFF",
	 overlayOpacity: "0.7",
	 modal: "true",
	 });
</script>

<%
call OpenSession()

dim vector(100,5)
dim vectorx(100,2)

hora_ini = 08
hora_fin = 20

wdia = date
whor = round(Hour(Now())+1,0)

num_con = 0

consultorio	= (request.form("t_consu"))
usuario  	= (request.form("t_usuario"))
consulta   	= 7'(request.form("t_consulta"))
fecha   	= wdia
acceso		= true

fecha_c1 = year(fecha) & "-" & ceros(month(fecha),2) & "-" & ceros(day(fecha),2)
fecha_c2 = year(fecha+consulta-1) & "-" & ceros(month(fecha+consulta-1),2) & "-" & ceros(day(fecha+consulta-1),2)

sql = "select count(*) as numero from cat_consultorios "
sql = sql & " where id_status=1 "
if consultorio<>"0" then
	sql = sql & " and id_consultorio='" & consultorio & "' "
end if
sql = sql & ";"
set rs = Conn.Execute(sql)
if not isnull(rs("numero")) then
	num_con = rs("numero")
end if
rs.close

'response.write num_con
'--------------------------------------------------------------------------------------------------------------------------------------------
conta = 1
sql = "select fecha,hora, max(id_consultorio) as num_con from dc_reservas "
sql = sql & " where (fecha>='" & fecha_c1 & "' and fecha<='" & fecha_c2 & "') "
sql = sql & " and id_usuario=" & usuario
sql = sql & " and estatus in ('RES','PAG') "
sql = sql & " group by fecha,hora; "
set rs = Conn.Execute(sql)
while not rs.eof
	vectorx(conta,0)= trim(rs("fecha")) & trim(ceros(rs("hora"),2))
	vectorx(conta,1)= cdbl(rs("num_con"))
	conta=conta+1
	rs.movenext
wend
rs.close
max_conta1 = conta - 1
'--------------------------------------------------------------------------------------------------------------------------------------------
'--------------------------------------------------------------------------------------------------------------------------------------------
conta = 1
sql = "select fecha,hora,count(*) as num,"
sql = sql & " sum(case when id_usuario=" & usuario & " then 1 else 0 end) as num_usu, "
sql = sql & " max(case when id_usuario=" & usuario & " then id_consultorio else 0 end) as num_con, "
sql = sql & " max(case when id_usuario=" & usuario & " and estatus='RES' THEN 1 else case when id_usuario=" & usuario 
sql = sql & " and estatus='PAG' THEN 2 end end) as tipo, "
sql = sql & " sum(case when id_usuario<>" & usuario & " then 1 else 0 end) as num_usu_sin "
sql = sql & " from dc_reservas "
sql = sql & " where (fecha>='" & fecha_c1 & "' and fecha<='" & fecha_c2 & "') "
sql = sql & " and estatus in ('RES','PAG') "
if consultorio<>"0" then
	sql = sql & " and id_consultorio='" & consultorio & "' "
end if
sql = sql & " group by fecha,hora;"
'response.write sql
set rs = Conn.Execute(sql)
while not rs.eof
	vector(conta,0)= trim(rs("fecha")) & trim(ceros(rs("hora"),2))
	vector(conta,1)= cdbl(rs("num"))
	vector(conta,2)= cdbl(rs("num_usu"))
	vector(conta,3)= cdbl(rs("num_con"))
	vector(conta,4)= rs("tipo")
	vector(conta,5)= cdbl(rs("num_usu_sin"))
	conta=conta+1
	rs.movenext
wend
rs.close
max_conta = conta - 1
'--------------------------------------------------------------------------------------------------------------------------------------------
'-------------------------------------------------------------------------------------------------------------------------------------------- 
w_numero = 0
sql = "select count(*) as w_numero "
sql = sql & " from dc_reservas "
sql = sql & " where estatus in ('RES') "
sql = sql & " and id_usuario='" & usuario & "' "
'if consultorio<>"0" then
'	sql = sql & " and id_consultorio='" & consultorio & "' "
'end if
sql = sql & ";"
'response.write sql
set rs = Conn.Execute(sql)
if not rs.eof then
	w_numero = rs("w_numero")
end if
rs.close
%>

<!--<input type="hidden" name="t_usuario"  	value="<%=usuario%>">!-->
<!--<input type="hidden" name="t_consulta" 	value="<%=consulta%>">!-->
<input type="hidden" name="t_fecha" value="<%=fecha%>">

<%
'--------------------------------------------------------------------------------------------------------------------------------------------
'--------------------------------------------------------------------------------------------------------------------------------------------
if acceso then%>
	<table cellpadding="0" cellspacing="0" border="0" width='55%'>
		<tr bgcolor="#FFFFFF">

		<td colspan="2" width='50%' align="center" valign="center"><font color="#274a65" face="tahoma" size="2">User:
		<select size="1" style="font-family: tahoma; font-size: 9pt;  width: 150px; height: 25px" name="t_usuario" onchange='document.forma.submit();'>
			<%
			sql = "select id_usuario,nombre from cat_usuarios where id_status=1 "
			sql = sql & " order by id_usuario; "
			set rs = Conn.Execute(sql)
			while not rs.eof%>
				<option <%if cdbl(usuario)=cdbl(rs("id_usuario")) then%>SELECTED<%end if%> VALUE="<%=trim(rs("id_usuario"))%>"><%=trim(rs("nombre"))%></option>
				<%rs.movenext
				wend
			rs.close%>
		</select>
		</td>

		<td colspan="2" width='50%' align="center" valign="center"><font color="#274a65" face="tahoma" size="2">Consultorio: 
		<select size="1" style="font-family: tahoma; font-size: 9pt;  width: 60px; height: 25px" name="t_consu" onchange='document.forma.submit();'>
			<option <%if cdbl(consultorio)="0" then%>SELECTED<%end if%> VALUE="0">Todos</option>
			<%
			sql = "select id_consultorio,nombre from cat_consultorios where id_status=1 "
			sql = sql & " order by id_consultorio; "
			set rs = Conn.Execute(sql)
			while not rs.eof%>
				<option <%if cdbl(consultorio)=cdbl(rs("id_consultorio")) then%>SELECTED<%end if%> VALUE="<%=trim(rs("id_consultorio"))%>"><%=trim(rs("id_consultorio"))%></option>
				<%rs.movenext
				wend
			rs.close%>
		</select>
		</td>
		<tr>

		<tr bgcolor="#FFFFFF">
		<td width='25%' align="left" valign="center"><font color="#274a65" face="tahoma" size="2">Ver:
		<select size="1" style="font-family: tahoma; font-size: 9pt;  width: 70px; height: 25px" name="t_consulta" onchange="movcalendar('<%=date%>');">
			<option <%if cdbl(consulta)=3 then%>SELECTED<%end if%> VALUE="3">3 días</option>
			<option <%if cdbl(consulta)=5 then%>SELECTED<%end if%> VALUE="5">5 días</option>
			<option <%if cdbl(consulta)=7 then%>SELECTED<%end if%> VALUE="7">7 días</option>
		</select>
		</td>

		<td width='25%' align="right" valign="center"><font color="#274a65" face="tahoma" size="2">Horas:
		<font color="#274a65" face="tahoma" size="2"><b><%=w_numero%></b>&nbsp;
		<a rel="shadowbox;width=600;height=400" title="" href="session18.asp?t_usuario=<%=usuario%>"><i class="fa fa-shopping-cart"></i></a>
		</td>

		<td width='25%' align="right" valign="center"><font color="#274a65" face="tahoma" size="2">
		<i class="fa fa-calendar"></i>&nbsp;<a href="javascript:movcalendar('<%=date%>');"><font face="tahoma" size="2">HOY</a>
		</td>

		<td width='25%' align="right" valign="center"><font color="#274a65" face="tahoma" size="2">
		<%if w_numero>0 then%>
			<a href="javascript:limpiar('<%=fecha%>','<%=usuario%>','5');"><font face="tahoma" size="2">Limpiar</a>
		<%end if%>
		</td>

		</tr>
	</table>

	<table cellpadding="2" cellspacing="4" border="0" width="60%">
	<tr height="30pt">
	<td width='05%' align="center" bgcolor="#F4F6F6">
		<%if cdate(fecha) > cdate(wdia) then%>
			<a href="javascript:movcalendar('<%=fecha-consulta%>');">
			<i class="fa fa-angle-double-left" style="font-size:27px"></i>
			</a>
		<%end if%>
	</td>
	<%for conta = 0 to consulta-1
		fecha_1 =  fecha + conta
		day_name  = LCase(WeekdayName(Weekday(fecha_1)))%>
		<td width='09%' align="center" bgcolor="#<%if cdate(fecha_1)=cdate(wdia) then%>33DDFF<%else%>EBF5FB<%end if%>">
			<font face="tahoma" size="2"><%=mid(day_name,1,3)%>
			<br>
			<%=day(fecha_1)%>-<%=mes(month(fecha_1))%>
		</td>
	<%next%>
	<td width='05%'align="center" bgcolor="#F4F6F6">
		<a href="javascript:movcalendar('<%=fecha+consulta%>');">
		<i class="fa fa-angle-double-right" style="font-size:27px"></i>
		</a>
	</td>

	</tr>
	<%for renglon=hora_ini to hora_fin%>
		<tr height="30pt">
		<td align="center" bgcolor="#<%if cdate(renglon)=hour(now()) then%>33DDFF<%else%>F4F6F6<%end if%>">
			<font face="tahoma" size="1"><%=ceros(renglon,2)%>:00
		</td>
		<%for fila=0 to consulta-1
			disponible = num_con
			fecha_x = year(fecha+fila) & "-" & ceros(month(fecha+fila),2) & "-" & ceros(day(fecha+fila),2) & trim(ceros(renglon,2))
			fecha_1 = year(fecha+fila) & ceros(month(fecha+fila),2) & ceros(day(fecha+fila),2) 
			horax_1 = trim(ceros(renglon,2))

			ocupacion = 0
			color = "e8ecdc"
			texto = round(division(ocupacion,num_con)*100,0)
			liga1 = "1"

			if consultorio <> 0 then
				xx = busca_1 ( trim(fecha_x), max_conta1 , vectorx )
				if xx <> -1 then
					if cdbl(vectorx(xx,1)) <> cdbl(consultorio) then
						liga1 = "0"
					end if
				end if
			end if

			xx = busca_1 ( trim(fecha_x), max_conta , vector )
			if xx <> -1 then
				ocupacion = vector(xx,1)
				texto = round(division(ocupacion,num_con)*100,0)
				if trim(vector(xx,5))=trim(num_con) then
					' Rojo No disponible
					color = "ed2e54"
					texto	 = ""
					liga1 	= "0"
				else
					disponible = disponible - vector(xx,1)
					if vector(xx,2)="1" then
						if vector(xx,4)="1" then
							' Azul claro Reservado (seleccionado, previo a realizar el pago)
							color = "c0adff"
							liga1 = "2"
						else
							' Azul Obscuro Pagado
							color = "7b6bb2"
							liga1 = "3"
						end if
					else
						liga1 = "1"
						if texto >= 25 then
							color = "b0d48c"
						end if
						if texto >= 50 then
							color = "588434"
						end if
						if texto >= 75 then
							color = "385424"
						end if
					end if
				end if
			end if

			if cdate(fecha+fila)=cdate(wdia) and renglon < whor then
				' Gris cuando la hora ya paso
				color = "BFC9CA"
				texto = ""
				liga1 = "0"
			end if
			%>

			<td align="center" bgcolor="#<%=color%>">
				<%if liga1="1" then%>
					<!--<a href="javascript:reserva('<%=fecha%>','<%=consultorio%>','<%=fecha_1%>','<%=horax_1%>','<%=usuario%>','1');" title='Reserva consultorio.'>!-->
					<input type="checkbox" name="opc" onchange="javascript:reserva('<%=fecha%>','<%=consultorio%>','<%=fecha_1%>','<%=horax_1%>','<%=usuario%>','1');" title="Reservar Consultorio. Ocupación: <%=texto%>% ">
				<%end if%>
				<%if liga1="2" then%>
					<a href="javascript:cancela('<%=fecha%>','<%=vector(xx,3)%>','<%=fecha_1%>','<%=horax_1%>','<%=usuario%>','2');" title='Cancelar reservación consultorio <%=vector(xx,3)%>. Ocupación: <%=texto%>% '>
					<i class="fa fa-map-marker"></i>
					</a>

				<%end if%>
				<%if liga1="3" then%>
					<a href="javascript:cancela('<%=fecha%>','<%=vector(xx,3)%>','<%=fecha_1%>','<%=horax_1%>','<%=usuario%>','4');" title='Cancelar reservación Consultorio <%=vector(xx,3)%>.'>
					<i class="fa fa-star"></i>
					</a>
				<%end if%>
			</td>
		<%next%>
		<td align="center" bgcolor="#<%if cdate(renglon)=hour(now()) then%>33DDFF<%else%>F4F6F6<%end if%>">
			<font face="tahoma" size="1"><%=ceros(renglon,2)%>:00
		</td>
		</tr>
	<%next%>
	</table>

	<table cellpadding="0" cellspacing="2" border="0" width='60%'>
		<tr height="30pt" bgcolor="#FFFFFF">
		<td bgcolor="#BFC9CA" width='10%' align="center" valign="center"><font color="#ffffff" face="tahoma" size="1">No disponible</td>
		<td bgcolor="#ed2e54" width='10%' align="center" valign="center"><font color="#ffffff" face="tahoma" size="1">Ocupado</td>
		<td bgcolor="#c0adff" width='10%' align="center" valign="center"><font color="#ffffff" face="tahoma" size="1">Reservado</td>
		<td bgcolor="#7b6bb2" width='10%' align="center" valign="center"><font color="#ffffff" face="tahoma" size="1">Asignado</td>
		<td bgcolor="#e8ecdc" width='10%' align="center" valign="center"><font color="#274a65" face="tahoma" size="1">Disponible</td>
		<td bgcolor="#b0d48c" width='10%' align="center" valign="center"><font color="#ffffff" face="tahoma" size="1">Disponible 75%</td>
		<td bgcolor="#588434" width='10%' align="center" valign="center"><font color="#ffffff" face="tahoma" size="1">Disponible 50%</td>
		<td bgcolor="#385424" width='10%' align="center" valign="center"><font color="#ffffff" face="tahoma" size="1">Disponible 25%</td>

		<td width='10%' align="center" valign="center"><font color="#274a65" face="tahoma" size="2">
		<a href="javascript:cancelatodo('<%=date%>','<%=usuario%>','6');"><font face="tahoma" size="2">Cancelar</a>
		</td>

		<td width='10%' align="center" valign="center"><font color="#274a65" face="tahoma" size="2">
		<%if w_numero>0 then%>
			<a href="javascript:terminar('<%=usuario%>');"><font face="tahoma" size="2">Terminar</a>
		<%end if%>
		</td>

		</tr>
	</table>
<%end if
Conn.Close
%>
</form>
</body>
</html>