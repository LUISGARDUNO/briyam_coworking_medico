<!-- #include file ="adovbs.inc" -->
<!-- #include file="function/config.asp" -->
<!-- #include file="function/function.asp" -->
<!-- #include file="function/seguridad.asp" -->

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<html class=" ">
<centrer>
<body link="#000080" vlink="#000080" text="#000000">
<form name="forma" method="post" action="calendar.asp" class="content">
<script>

function actualizar(){location.reload(true);}
//Función para actualizar cada 4 segundos(4000 milisegundos)
  setInterval("actualizar()",9000);

function movcalendar(fecha1)
	{
	document.forma.t_fecha.value=fecha1;
	document.forma.submit();
	}

function cancela(fecha,t_consu,t_fecha,t_hora,t_usuario,t_mov)
	{
	var opcion = confirm("¿ Seguro de cancelar reservación ?");
    if (opcion == true) {
		tipo = 'atn.asp?fecha='+fecha+'&t_consu='+t_consu+'&t_fecha='+t_fecha+'&t_hora='+t_hora+'&t_usuario='+t_usuario+'&t_mov='+t_mov+'&t_consulta=<%=cdbl(request.form("t_consulta"))%>&consultorio=<%=cdbl(request.form("t_consu"))%>';
		window.open(tipo,'','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=150,height=150,left=600,top=200');
		}
	}

function reserva(fecha,t_consu,t_fecha,t_hora,t_usuario,t_mov)
	{
	var opcion = confirm("¿ Confirmar reservación ?");
    if (opcion == true) {
		tipo = 'atn.asp?fecha='+fecha+'&t_consu='+t_consu+'&t_fecha='+t_fecha+'&t_hora='+t_hora+'&t_usuario='+t_usuario+'&t_mov='+t_mov+'&t_consulta=<%=cdbl(request.form("t_consulta"))%>&consultorio=<%=cdbl(request.form("t_consu"))%>';
		window.open(tipo,'','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=150,height=150,left=600,top=200');
		}
	}

</script>

<link rel="stylesheet" href="shadowbox/shadowbox.css">
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

hora_ini = 08
hora_fin = 20

wdia = date
whor = round(Hour(Now())+1,0)

num_con = 0

consultorio	= cdbl(request.form("t_consu"))
usuario  	= cdbl(request.form("t_usuario"))
consulta   	= cdbl(request.form("t_consulta"))
fecha   	= cdate(request.form("t_fecha"))
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

conta = 1
sql = "select fecha,hora,count(*) as num,"
sql = sql & " sum(case when id_usuario=" & usuario & " then 1 else 0 end) as num_usu, "
sql = sql & " max(case when id_usuario=" & usuario & " then id_consultorio else 0 end) as num_con, "
sql = sql & " max(case when id_usuario=" & usuario & " and estatus='RES' THEN 1 else case when id_usuario=" & usuario & " and estatus='PAG' THEN 2 end end) as tipo, "
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

w_numero = 0
sql = "select count(*) as w_numero "
sql = sql & " from dc_reservas "
sql = sql & " where estatus in ('RES') "
sql = sql & " and id_usuario='" & usuario & "' "
if consultorio<>"0" then
	sql = sql & " and id_consultorio='" & consultorio & "' "
end if
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
<input type="hidden" name="t_fecha"  	value="<%=fecha%>">

<%
'-----------------------------
if acceso then%>
	<table cellpadding="0" cellspacing="0" border="0" width='55%'>
		<tr bgcolor="#FFFFFF">

		<td width='20%' align="left" valign="center"><font color="#274a65" face="tahoma" size="2">User:
		<select size="1" style="font-family: tahoma; font-size: 9pt;  width: 100px; height: 30px" name="t_usuario" onchange='document.forma.submit();'>
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

		<td width='20%' align="right" valign="center"><font color="#274a65" face="tahoma" size="2">Consultorio:
		<select size="1" style="font-family: tahoma; font-size: 9pt;  width: 60px; height: 30px" name="t_consu" onchange='document.forma.submit();'>
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

		<td width='20%' align="right" valign="center"><font color="#274a65" face="tahoma" size="2">Ver: 
		<select size="1" style="font-family: tahoma; font-size: 9pt;  width: 70px; height: 30px" name="t_consulta" onchange="movcalendar('<%=date%>');">
			<option <%if cdbl(consulta)=3 then%>SELECTED<%end if%> VALUE="3">3 días</option>
			<option <%if cdbl(consulta)=5 then%>SELECTED<%end if%> VALUE="5">5 días</option>
			<option <%if cdbl(consulta)=7 then%>SELECTED<%end if%> VALUE="7">7 días</option>
		</select>
		</td>

		<td width='20%' align="right" valign="center"><font color="#274a65" face="tahoma" size="2">Horas: 
		<font color="#274a65" face="tahoma" size="2"><b><%=w_numero%></b>
		</td>

		<td width='20%' align="right" valign="center"><font color="#274a65" face="tahoma" size="2">
		<input type="button" value="Terminar" style="font-family: tahoma; font-size: 10pt; background-color: #3371FF; color: #FFFFFF;" >	
		</td>

		</tr>
	</table>

	<table cellpadding="3" cellspacing="3" border="0" width="60%">
	<tr height="30pt">
	<td width='05%' align="center" bgcolor="#F4F6F6">
		<%if cdate(fecha) > cdate(wdia) then%>
			<a href="javascript:movcalendar('<%=fecha-consulta%>');"><font face="tahoma" size="1"><<<</a>
			<br>
			<a href="javascript:movcalendar('<%=date%>');"><font face="tahoma" size="1"><b>HOY</b></a>
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
		<a href="javascript:movcalendar('<%=fecha+consulta%>');"><font face="tahoma" size="1">>>></a>
		<br>
		<a href="javascript:movcalendar('<%=date%>');"><font face="tahoma" size="1"><b>HOY</b></a>
	</td>

	</tr>
	<%for renglon=hora_ini to hora_fin%>
		<tr height="34pt">
		<td align="center" bgcolor="#<%if cdate(renglon)=hour(now()) then%>33DDFF<%else%>F4F6F6<%end if%>">
			<font face="tahoma" size="1"><%=ceros(renglon,2)%>:00
		</td>
		<%for fila=0 to consulta-1
			color = "E5E7E9"
			texto = ""
			liga1 = "0"

			disponible = num_con
			fecha_x = year(fecha+fila) & "-" & ceros(month(fecha+fila),2) & "-" & ceros(day(fecha+fila),2) & trim(ceros(renglon,2))
			fecha_1 = year(fecha+fila) & ceros(month(fecha+fila),2) & ceros(day(fecha+fila),2) 
			horax_1 = trim(ceros(renglon,2))
			xx = busca_1 ( trim(fecha_x), max_conta , vector )

			if xx <> -1 then
				if trim(vector(xx,5))=trim(num_con) then
					color = "F5B7B1"
					if consultorio="0" then
						texto = "Todos<br>reservados"
					else
						texto = "Reservado"
					end if
					liga1 = "3"
				else
					disponible = disponible - vector(xx,1)
					if vector(xx,2)="1" then
						if vector(xx,4)="1" then
							if consultorio="0" then
								texto = "Consultorio <b>" & vector(xx,3) & "</b>"
							else
								texto = "Reservado"
							end if

							color = "96FF33"
							liga1 = "1"
						else
							if consultorio="0" then
								texto = "Consultorio <b>" & vector(xx,3) & "</b>"
							else
								texto = "Pagado"
							end if

							color = "3390FF"
							liga1 = "3"
						end if
					end if
				end if
			end if

			if cdate(fecha+fila)=cdate(wdia) and renglon < whor then
				color = "BFC9CA"
				liga1 = "2"
			end if
			%>

			<td align="center" bgcolor="#<%=color%>">
				<%if liga1="0" or liga1="2" then%>
					<%if liga1="0" then%>
						<a href="javascript:reserva('<%=fecha%>','<%=consultorio%>','<%=fecha_1%>','<%=horax_1%>','<%=usuario%>','1');" title='Reserva consultorio.'>
					<%end if%>
					<font face="tahoma" size="1">
					<%if trim(disponible)="1" then%>
						Reserva
					<%else%>
						<%=disponible%>
					<%end if%>
					</a>
				<%else%>
					<%if liga1="1" or liga1="2" then%>
						<%if liga1="1" then%>
							<a href="javascript:cancela('<%=fecha%>','<%=vector(xx,3)%>','<%=fecha_1%>','<%=horax_1%>','<%=usuario%>','2');" title='Cancelar reservación consultorio <%=vector(xx,3)%>.'>
						<%end if%>
						<font face="tahoma" size="1"><%=texto%>
						</a>
					<%else%>
						<font face="tahoma" size="1"><%=texto%>
					<%end if%>
				<%end if%>
			</td>
		<%next%>
		<td align="center" bgcolor="#<%if cdate(renglon)=hour(now()) then%>33DDFF<%else%>F4F6F6<%end if%>">
			<font face="tahoma" size="1"><%=ceros(renglon,2)%>:00
		</td>
		</tr>
	<%next%>
	</table>
<%end if
Conn.Close
%>
</form>
</body>
</html>