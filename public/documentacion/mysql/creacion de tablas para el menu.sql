--CREACIÓN DE TABLAS

CREATE TABLE usuarios (
	id_user bigint AUTO_INCREMENT PRIMARY KEY,
    empleado_id bigint not null UNIQUE,
    usuario varchar(30) NOT null UNIQUE,
	contrasena varchar(30) not null,
	change_pass tinyint not null, --0 is inactivo // 1 is activo
	estado_id tinyint not null,
	fecha_create datetime not null,
	FOREIGN KEY (empleado_id) REFERENCES empleados(id),
    FOREIGN KEY (estado_id) REFERENCES estados(id)
);

CREATE TABLE perfiles (
	id_perfil tinyint AUTO_INCREMENT PRIMARY KEY,
    perfil varchar(50) not null UNIQUE
);

ALTER TABLE usuarios
ADD perfil_id tinyint;


ALTER TABLE usuarios
ADD FOREIGN KEY (perfil_id) REFERENCES perfiles(id_perfil);



CREATE TABLE menus (
	id_menu int AUTO_INCREMENT PRIMARY KEY,
    menu varchar(50) not null UNIQUE,
    icono varchar (200) not null
);

INSERT INTO `menus`(`menu`, `icono`) VALUES ('CONFIGURACION','ik ik-settings');

CREATE TABLE submenus (
	id_submenu int AUTO_INCREMENT PRIMARY KEY,
    submenu varchar(50) not null UNIQUE,
    path varchar(200) not null,
	icono varchar (200) not null,
	menu_id int not null,
	FOREIGN KEY (menu_id) REFERENCES menus(id_menu)
);

INSERT INTO `submenus`(`submenu`, `path`, `icono`, `menu_id`) 
VALUES ('MENUS','MenuController','ik ik-menu',1);

INSERT INTO `submenus`(`submenu`, `path`, `icono`, `menu_id`) 
VALUES ('SUBMENUS','MenuController/submenus','ik ik-align-justify',1);

CREATE TABLE perfiles_menus (
	id_p_m int AUTO_INCREMENT PRIMARY KEY,
    perfil_id tinyint not null,
	menu_id int not null,
    FOREIGN KEY (perfil_id) REFERENCES perfiles(id_perfil),
    FOREIGN KEY (menu_id) REFERENCES menus(id_menu)
);

INSERT INTO `perfiles_menus`( `perfil_id`, `menu_id`) VALUES (1,1);

CREATE TABLE perfiles_submenus (
	id_p_m int AUTO_INCREMENT PRIMARY KEY,
    perfil_id tinyint not null,
	submenu_id int not null,
    FOREIGN KEY (perfil_id) REFERENCES perfiles(id_perfil),
    FOREIGN KEY (submenu_id) REFERENCES submenus(id_submenu)
);

INSERT INTO `perfiles_submenus`(`perfil_id`, `submenu_id`) VALUES (1,1);
INSERT INTO `perfiles_submenus`(`perfil_id`, `submenu_id`) VALUES (1,2);

CREATE TABLE tipo_solicitudes 
(
	id_tipo tinyint AUTO_INCREMENT PRIMARY KEY,
    tipo_solicitud varchar(100) not null
);

INSERT INTO `tipo_solicitudes`(`tipo_solicitud`) VALUES ('CORREO ELECTRONICO');
INSERT INTO `tipo_solicitudes`(`tipo_solicitud`) VALUES ('LLAMADA');


CREATE TABLE solicitudes_prospecto
(
	id_solicitud bigint AUTO_INCREMENT PRIMARY KEY,
   	prospecto varchar(200) not null,
    correo varchar(200) not null,
    telefono bigint null,
    id_municipio int not null,
    direccion varchar(200) null,
    observacion text not null,
    usuario varchar(30) NOT null,
	fecha_creado datetime not null,
    id_tipo_solicitud tinyint not null,    
    FOREIGN KEY (id_municipio) REFERENCES municipios(id),
    FOREIGN KEY (id_tipo_solicitud) REFERENCES tipo_solicitudes(id_tipo)
);

CREATE TABLE clientes
(
   id_cliente bigint AUTO_INCREMENT PRIMARY KEY, 
   id_tercero bigint not null UNIQUE,
   usuario_registro bigint not null,
   fecha_registro datetime not null,
   FOREIGN KEY (id_tercero) REFERENCES terceros(id),
    FOREIGN KEY (usuario_registro) REFERENCES usuarios(id_user)
);

CREATE TABLE proveedores
(
   id_proveedor bigint AUTO_INCREMENT PRIMARY KEY, 
   id_tercero bigint not null UNIQUE,
   usuario_registro varchar(100) not null,
   fecha_registro datetime not null,
   FOREIGN KEY (id_tercero) REFERENCES terceros(id)
);


CREATE TABLE categorias
(
	id_categoria int AUTO_INCREMENT PRIMARY KEY,
    categoria varchar(300) not null unique
);

CREATE TABLE tipos_productos
(
	id_tipo int AUTO_INCREMENT PRIMARY KEY,
    tipo varchar(300) not null unique,
    id_categoria_c int not null,
    FOREIGN KEY (id_categoria_c) REFERENCES categorias(id_categoria)
);

CREATE TABLE productos
(
    id_producto bigint AUTO_INCREMENT PRIMARY KEY,
    referencia varchar(1000) not null,
    descripcion varchar(1000) null,
    anchos_tela_metro varchar(200) null,
    unidad_medida varchar(200) null,
	factor_apertura varchar(200) null,
	costo_elite bigint not null,
    costo_premium bigint null,
    id_tipo_p int not null,
    FOREIGN KEY (id_tipo_p) REFERENCES tipos_productos(id_tipo)
);

ALTER TABLE productos
ADD FOREIGN KEY (proveedor_id) REFERENCES proveedores(id_proveedor);

INSERT INTO `categorias`( `categoria`) VALUES ('CORTINAS');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) VALUES ('CORTINA ENROLLABLE EN SCREEN','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('CORTINA ENROLLABLE COLECCIÓN EUROPEA','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('CORTINA ENROLLABLE EN SHEER ELEGANCE','1');


INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('CORTINA ENROLLABLE EN BLACKOUT','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MEMBRANAS','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('SCREEN','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('ACCESORIOS PARA ENROLLABLES','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('PANEL JAPONÉS EN SCREEN','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('PANEL JAPONÉS COLECCIÓN EUROPEA (POLIÉSTER)','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('PANEL JAPONÉS EN TELA SHEER ELEGANCE','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('PANEL JAPONÉS BLACK OUT','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('PANEL JAPONÉS EN TELA SHEER ELEGANCE','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MEMBRANAS','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('SCREEN PARA EXTERIORES','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('SISTEMAS PANEL JAPONÉS','1');


INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('CORTINA ROMANA EN SCREEN','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('CORTINA ROMANA COLECCIÓN EUROPEA','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('CORTINA ROMANA BLACKOUT','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('PERSIANA VERTICAL EN SCREEN','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('PERSIANA VERTICAL COLECCIÓN EUROPEA','1');


INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('PERSIANA VERTICAL EN BLACKOUT','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('SISTEMA VERTICAL','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('CORTINA SHANGRI - LA Y SHEER ELEGANCE (DOBLE TELA)','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('CORTINA HANNA','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('OUTLET - LÍNEA ESPECIAL','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORIZACIÓN CORTINA ENROLLABLE','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORIZACIÓN PANEL JAPONÉS','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORIZACIÓN CORTINA ROMANA Y MACROMADERA','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORIZACIÓN SHEER ELEGANCE','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('ACCESORIOS MOTORIZACIÓN PEL #1','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORES RECARGABLES PEL #1','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('ACCESORIOS MOTORES RECARGABLES PEL #1','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORIZACIÓN CORTINA ENROLLABLE PX','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('ACCESORIOS MOTORES RECARGABLES PEL #1','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORIZACIÓN PANEL JAPONÉS PX','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORIZACIÓN CORTINA ROMANA Y MACROMADERA PX','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORIZACIÓN SHEER ELEGANCE PX','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('ACCESORIOS MOTORIZACIÓN PX','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('LÍNEA PEL # 2 MOTORIZACIÓN  Y  AUTOMATIZACIÓN CORTINA  ENROLLABLE','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('ACCESORIOS MOTORES PEL #2','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORES RECARGABLES PEL #2','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('ACCESORIOS MOTORES RECARGABLES PEL #2','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORIZACIÓN CORTINA ENROLLABLE','1');

INSERT INTO `tipos_productos`( `tipo`, `id_categoria_c`) 
VALUES ('MOTORIZACIÓN CORTINA  ENROLLABLE','1');

/* PRODUCTOS DE PERSIANAAS */

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR SCR 3001 *','SOLAR SCR 3001 *','1,60 - 2,00 - 2,50','1','1','55000','74000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR SCR 3003 *','SOLAR SCR 3003 *','1,60 - 2,00 - 2,50 - 3,00','1','3','50500','68000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR SCR 3005 *','SOLAR SCR 3005 *','1,60 - 2,00 - 2,50 - 3,00','1','5','46000','63000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 303 *','SCREEN 303 *','1,83 - 2,50','1','3','69000','88000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 305 *','SCREEN 305 *','1,83 - 2,50','1','5','69500','88000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 310','SCREEN 310','1,83','1','10','45900','63000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 401 *','SCREEN 401 *','1,83 - 2,50','1','1','69000','88000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 410-L','SCREEN 410-L','1,83 - 2,50 - 3,00','1','10','49500','68000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 411','SCREEN 411','1,80 - 2,50','1','11','65000','84000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 412','SCREEN 412','1,83 - 2,50 - 3,00','1','12','65000','84000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 416-L','SCREEN 416-L','1,83 - 2,50','1','16','51500','70000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 420','SCREEN 420','1,83 - 2,50','1','10','59500','79000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 425','SCREEN 425','1,83 - 2,50','1','5','55000','74000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 508 NEW CRYSTAL','SCREEN 508 NEW CRYSTAL','1,80 - 2,50','1','8','79000','99000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 511 ESPIGA','SCREEN 511 ESPIGA','1,80 - 2,50','1','11','84000','104000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 523','SCREEN 523','2,00 - 2,50','1','3','65000','84000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 550 CRISTAL','SCREEN 550 CRISTAL','1,83 - 2,50 - 3,00','1','5','69600','89000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 573 RUSTICO','SCREEN 573 RUSTICO','2,00 - 2,50 - 3,00','1','3','82550','103700','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN ESTUCO','SCREEN ESTUCO','2,00 - 2,50','1','5','59000','78000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN GRANITO','SCREEN GRANITO','1,83 - 2,50','1','3','65000','84000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN JACQUARD CORCEGA','SCREEN JACQUARD CORCEGA','2,00 - 2,60','1','7','72000','92000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN JACQUARD INCANTO','SCREEN JACQUARD INCANTO','2,00 - 2,60','1','3','72000','92000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN PALMA','SCREEN PALMA','2,43','1','7','84000','104000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN PLATINUM','SCREEN PLATINUM','2,00 - 2,50','1','3','84000','104000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN RATAN','SCREEN RATAN','1,83 - 2,50','1','5','67900','86000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN REFLECTIVE *','SCREEN REFLECTIVE *','1,83 - 2,00 - 2,50','1','3','84000','104000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN SPIRAL','SCREEN SPIRAL','2,43','1','7','84000','104000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN WINTER','SCREEN WINTER','2,43','1','7','84000','104000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 4000','SCREEN 4000','1,83 - 2,50','1','0','72000','92000','1','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN ESTUCO CRYSTAL','SCREEN ESTUCO CRYSTAL','1,83 - 2,50','1','5','64000','83000','1','1','30');

CREATE TABLE tela_tipo_medida
(
	id_medida tinyint AUTO_INCREMENT PRIMARY KEY,
    medidad varchar(50) UNIQUE
);

INSERT INTO `tela_tipo_medida`( `medidad`) VALUES ('METROS');

ALTER TABLE productos
ADD FOREIGN KEY (unidad_medida) REFERENCES tela_tipo_medida(id_medida);



INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR ATENAS','SOLAR ATENAS','2,00 - 2,40','1','Trasluz','38000','56000','2','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR LISBOA','SOLAR LISBOA','2,4','1','Trasluz','64000','83000','2','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR LISBOA PRINTED','SOLAR LISBOA PRINTED','2,4','1','Trasluz','67000','86000','2','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR MONACO','SOLAR MONACO','1,95','1','Trasluz','53000','71000','2','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR MUCUR','SOLAR MUCUR','2,8','1','Trasluz','47000','65000','2','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR TOKYO','SOLAR TOKYO','2,8','1','Trasluz','47000','65000','2','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR TOLEDO','SOLAR TOLEDO','2','1','Trasluz','53000','71000','2','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG INSPIRACION','SHEER ELEG INSPIRACION','2,00 - 2,45 - 2,75','1','Trasluz','60400','79000','3','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR (M.A - M.C)','SHEER ELEG SCR (M.A - M.C)','1,50 - 1,83 - 2,50 - 3,00','1','Trasluz','60400','79000','3','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR 2T (M.A - M.C)','SHEER ELEG SCR 2T (M.A - M.C)','1,50 - 1,83 - 2,50','1','Trasluz','60400','79000','3','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR 2T WIDE (M.A - M.C)','SHEER ELEG SCR 2T WIDE (M.A - M.C)','1,83 - 2,20 - 2,50','1','Trasluz','65650','84000','3','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR CLASICA M.C','SHEER ELEG SCR CLASICA M.C','1,83 - 2,50','1','Trasluz','60400','79000','3','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR COMBI 3 (M.A - M.C)','SHEER ELEG SCR COMBI 3 (M.A - M.C)','1,83 - 2,50','1','Trasluz','60400','79000','3','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR CRYSTAL','SHEER ELEG SCR CRYSTAL','1,83 - 2,50','1','Trasluz','60400','79000','3','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR EXTRA WIDE','SHEER ELEG SCR EXTRA WIDE','2,2','1','Trasluz','60400','79000','3','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR TRAZOS M.C','SHEER ELEG SCR TRAZOS M.C','1,83 - 2,50','1','Trasluz','60400','79000','3','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR WIDE (M.A - M.C)','SHEER ELEG SCR WIDE (M.A - M.C)','1,83 - 2,50','1','Trasluz','65650','84000','3','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR WIDE COMBI 3 (M.A - M.C)','SHEER ELEG SCR WIDE COMBI 3 (M.A - M.C)','1,83 - 2,20','1','Trasluz','65650','84000','3','1','30');


-----
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT DUAL COLOR **','BLACKOUT DUAL COLOR **','2,00 - 2,80','1','Blackout','69000','88000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT PRINTED **','BLACKOUT PRINTED **','1,60 - 2,00 - 2,50','1','Blackout','46000','63000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT TEX **','BLACKOUT TEX **','2,00 - 3,00','1','Blackout','76000','95000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT STAR **','BLACKOUT STAR **','3,1','1','Blackout','105000','126000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT APOLO **','BLACKOUT APOLO **','4,1','1','Blackout','120000','140000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT PEACOCK METALLIC **','BLACKOUT PEACOCK METALLIC **','2,75','1','Blackout','69000','88000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT ATENAS **','BLACKOUT ATENAS **','2,00 - 2,40 - 3,00','1','Blackout','62000','81000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT GLITTER **','BLACKOUT GLITTER **','2,4','1','Blackout','120000','140000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT LINO **','BLACKOUT LINO **','2,4','1','Blackout','110000','130000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT LISBOA **','BLACKOUT LISBOA **','2,40 - 3,05','1','Blackout','79000','98000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT ECO Ancho hasta 2,00m tubo 1 1/4 pulgadas  control R8 max 4MT²','BLACKOUT ECO Ancho hasta 2,00m tubo 1 1/4 pulgadas  control R8 max 4MT²','1,60 - 2,00 - 2,50','1','Blackout','34000','52000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT ECO Ancho hasta 2,40m tubo 1 1/2 pulgadas  control R16 max 6MT² SIN EMPATE','BLACKOUT ECO Ancho hasta 2,40m tubo 1 1/2 pulgadas  control R16 max 6MT² SIN EMPATE','1,60 - 2,00 - 2,50','1','Blackout','39000','56000','4','1','30');


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) VALUES ('BLACKOUT MATTE ASIA Ancho hasta 2,00m tubo 1 1/4 pulgadas 
control R8 max 4MT²','BLACKOUT MATTE ASIA Ancho hasta 2,00m tubo 1 1/4 pulgadas 
control R8 max 4MT²','1,83','1','Blackout','42500','61000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) VALUES ('BLACKOUT MATTE ASIA - Ancho hasta 2,40m tubo1 1/2 pulgadas 
control R16 max 6MT² SIN EMPATE','BLACKOUT MATTE ASIA - Ancho hasta 2,40m tubo1 1/2 pulgadas 
control R16 max 6MT² SIN EMPATE','2,4','1','Blackout','46500','65500','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) VALUES ('BLACKOUT MATTE ASIA - Ancho hasta 3,00m tubo 2 pulgadas 
control R24 max 8MT² SIN EMPATE','BLACKOUT MATTE ASIA - Ancho hasta 3,00m tubo 2 pulgadas 
control R24 max 8MT² SIN EMPATE','3','1','Blackout','55000','77000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) VALUES ('BLACKOUT MATTE ASIA - Ancho hasta 3,60m tubo 2 1/2 pulgadas 
control R24 unicamente. max 9,0MT²','BLACKOUT MATTE ASIA - Ancho hasta 3,60m tubo 2 1/2 pulgadas 
control R24 unicamente. max 9,0MT²','3','1','Blackout','67000','95000','4','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) VALUES ('BLACKOUT MATTE ASIA Superior a 3,00m ancho
empatado para motorización','BLACKOUT MATTE ASIA Superior a 3,00m ancho
empatado para motorización','3','1','Blackout','55000','84000','4','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) VALUES ('BLACKOUT MOIRE Ancho hasta 1,80m tubo 1 1/4 pulgadas  control
R8 max 4MT²','BLACKOUT MOIRE Ancho hasta 1,80m tubo 1 1/4 pulgadas  control
R8 max 4MT²','1,83','1','Blackout','47500','66000','4','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) VALUES ('BLACKOUT MOIRE - Ancho hasta 2,40m tubo1 1/2 pulgadas 
control R16 max 6MT² EMPATADO','BLACKOUT MOIRE - Ancho hasta 2,40m tubo1 1/2 pulgadas 
control R16 max 6MT² EMPATADO','2,4','1','Blackout','52500','72000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) VALUES ('BLACKOUT MOIRE - Ancho hasta 3,00m tubo 2 pulgadas  control R24 max 8MT² EMPATADO','BLACKOUT MOIRE - Ancho hasta 3,00m tubo 2 pulgadas  control R24 max 8MT² EMPATADO','3','1','Blackout','62000','81500','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) VALUES ('BLACKOUT MOIRE - Ancho hasta 3,60m tubo 2 1/2 pulgadas  control R24 unicamente max 9,0 MT² EMPATADO','BLACKOUT MOIRE - Ancho hasta 3,60m tubo 2 1/2 pulgadas  control R24 unicamente max 9,0 MT² EMPATADO','3','1','Blackout','72000','99000','4','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) VALUES ('BLACKOUT MOIRE Superior a 3,00m Ancho Empatado
para motorización','BLACKOUT MOIRE Superior a 3,00m Ancho Empatado
para motorización','3','1','Blackout','62000','89000','4','1','30');

-----
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLTIS 88','SOLTIS 88','1,77 - 2,67','1','8','132000','155000','5','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLTIS 92','SOLTIS 92','1,77 - 2,67','1','5','140000','163000','5','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN PARA EXTERIORES','SCREEN PARA EXTERIORES','3','1','3','79000','99000','6','1','30');


------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Soporte central R8 Galvanizado','Soporte central R8 Galvanizado','2','1','','2300','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Soporte central R16 Galvanizado','Soporte central R16 Galvanizado','2','1','','3000','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Soporte central R16 S Corto','Soporte central R16 S Corto','3','1','','7000','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Juego de guaya para toldo verrtica (Incluye cables para toldos hasta 3m de alto y accesorios para anclaje)','Juego de guaya para toldo verrtica (Incluye cables para toldos hasta 3m de alto y accesorios para anclaje)','3','1','','120000','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Guaya metálica persianas 1/8','Guaya metálica persianas 1/8','1','1','','6000','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Tensor escualizable guaya grad balin','Tensor escualizable guaya grad balin','2','1','','60000','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Soporte central con bujes para 2 enrollables tubo 1 1/2','Soporte central con bujes para 2 enrollables tubo 1 1/2','3','1','','7700','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Perfil lateral para oscuridad total (incluye felpa interna)','Perfil lateral para oscuridad total (incluye felpa interna)','1','1','','12500','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Perfil lateral enrollable blanco especial para oscuridad total Cortinas motorizadas','Perfil lateral enrollable blanco especial para oscuridad total Cortinas motorizadas','1','1','','18000','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Tubo Acero inox 1 - incluye bujes plásticos laterales (Especial para toldo vertical PEL)','Tubo Acero inox 1 - incluye bujes plásticos laterales (Especial para toldo vertical PEL)','1','1','','35000','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Tubo de Aluminio sin bujes','Tubo de Aluminio sin bujes','1','1','','8800','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Tubo de Aluminio con bujes','Tubo de Aluminio con bujes','1','1','','13200','','7','1','30');




------------
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR SCR 3001','SOLAR SCR 3001','1,60 - 2,00 - 2,50','1','1','69900','61000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR SCR 3003','SOLAR SCR 3003','1,60 - 2,00 - 2,50 - 3,00','1','3','65500','57500','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR SCR 3005','SOLAR SCR 3005','1,60 - 2,00 - 2,50 - 3,00','1','5','59500','52000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 303','SCREEN 303','1,83 - 2,50','1','3','85000','74500','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 305','SCREEN 305','1,83 - 2,50','1','5','75000','65500','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 310','SCREEN 310','1,83','1','10','59500','57500','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 401','SCREEN 401','1,83 - 2,50','1','1','87000','76000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 410-L','SCREEN 410-L','1,83 - 2,50 - 3,00','1','10','62500','55000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 411','SCREEN 411','1,80 - 2,50','1','11','84000','74000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 412','SCREEN 412','1,83 - 2,50 - 3,00','1','12','84000','74000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 416-L','SCREEN 416-L','1,83 - 2,50','1','16','65500','57300','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 420','SCREEN 420','1,83 - 2,50','1','10','75000','65500','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 425','SCREEN 425','1,83 - 2,50','1','5','72000','63000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 508 NEW CRYSTAL','SCREEN 508 NEW CRYSTAL','1,80 - 2,50','1','8','99000','87000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 511 ESPIGA','SCREEN 511 ESPIGA','1,80 - 2,50','1','11','105000','92000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 523','SCREEN 523','2,00 - 2,50','1','3','82000','72000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 550 CRISTAL','SCREEN 550 CRISTAL','1,83 - 2,50 - 3,00','1','5','86000','75000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 573 RUSTICO','SCREEN 573 RUSTICO','2,00 - 2,50 - 3,00','1','3','105000','92000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN ESTUCO','SCREEN ESTUCO','2,00 - 2,50','1','5','75000','65500','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN GRANITO','SCREEN GRANITO','1,83 - 2,50','1','3','75000','65500','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN JACQUARD CORCEGA','SCREEN JACQUARD CORCEGA','2,00 - 2,60','1','7','90000','79000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN JACQUARD INCANTO','SCREEN JACQUARD INCANTO','2,00 - 2,60','1','3','90000','79000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN PALMA','SCREEN PALMA','2,43','1','7','105000','92000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN PLATINUM','SCREEN PLATINUM','2,00 - 2,50','1','3','105000','92000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN RATAN','SCREEN RATAN','1,83 - 2,50','1','5','84000','74000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN REFLECTIVE','SCREEN REFLECTIVE','1,83 - 2,00 - 2,50','1','3','105000','92000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN SPIRAL','SCREEN SPIRAL','2,43','1','7','105000','92000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN WINTER','SCREEN WINTER','2,43','1','7','105000','92000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 4000','SCREEN 4000','1,83 - 2,50','1','0','92000','81000','8','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN ESTUCO CRYSTAL','SCREEN ESTUCO CRYSTAL','1,83 - 2,50','1','5','82000','72000','8','1','30');



----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR ATENAS','SOLAR ATENAS','2,00 - 2,40','1','Trasluz','50000','45000','9','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR LISBOA','SOLAR LISBOA','2,4','1','Trasluz','85000','75000','9','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR LISBOA PRINTED','SOLAR LISBOA PRINTED','2,4','1','Trasluz','88000','79000','9','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR MONACO','SOLAR MONACO','1,95','1','Trasluz','68000','61000','9','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR MUCUR','SOLAR MUCUR','2,8','1','Trasluz','64000','58000','9','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR TOKYO','SOLAR TOKYO','2,8','1','Trasluz','64000','58000','9','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR TOLEDO','SOLAR TOLEDO','2','1','Trasluz','68000','61000','9','1','30');



INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`
);

 ;

VALUES ('SHEER ELEG INSPIRACION','SHEER ELEG INSPIRACION','2,00 - 2,45 - 2,75','1','Trasluz','64000','57000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG NEW SANTA FE WIDE B.O.','SHEER ELEG NEW SANTA FE WIDE B.O.','2,8','1','Trasluz','90000','80000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG PLISADA','SHEER ELEG PLISADA','2,6','1','Trasluz','82000','72000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG PLISADA ECO','SHEER ELEG PLISADA ECO','3','1','Trasluz','68000','60000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG PLISADA WIDE','SHEER ELEG PLISADA WIDE','2,6','1','Trasluz','82000','72000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR (M.A - M.C)','SHEER ELEG SCR (M.A - M.C)','1,50 - 1,83 - 2,50 - 3,00','1','Trasluz','82000','72000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR 2T WIDE (M.A - M.C)','SHEER ELEG SCR 2T WIDE (M.A - M.C)','1,50 - 1,83 - 2,50','1','Trasluz','82000','72000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR CLASICA M.C','SHEER ELEG SCR CLASICA M.C','1,83 - 2,20 - 2,50','1','Trasluz','82000','72000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR COMBI 3 (M.A - M.C)','SHEER ELEG SCR COMBI 3 (M.A - M.C)','1,83 - 2,50','1','Trasluz','82000','72000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR CRYSTAL','SHEER ELEG SCR CRYSTAL','1,83 - 2,50','1','Trasluz','82000','72000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR EXTRA WIDE','SHEER ELEG SCR EXTRA WIDE','1,83 - 2,50','1','Trasluz','82000','72000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR TRAZOS M.C','SHEER ELEG SCR TRAZOS M.C','2,2','1','Trasluz','82000','72000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR WIDE (M.A - M.C)','SHEER ELEG SCR WIDE (M.A - M.C)','1,83 - 2,50','1','Trasluz','82000','72000','10','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR WIDE COMBI 3 (M.A - M.C)','SHEER ELEG SCR WIDE COMBI 3 (M.A - M.C)','1,83 - 2,20','1','Trasluz','82000','72000','10','1','30');


----------------------------------------------------------------


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT DUAL COLOR','BLACKOUT DUAL COLOR','2,00 - 2,80','1','Blackout','87000','77000','11','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT PRINTED','BLACKOUT PRINTED','1,60 - 2,00 - 2,50','1','Blackout','60000','53000','11','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT TEX','BLACKOUT TEX','2,00 - 3,00','1','Blackout','96000','85000','11','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT STAR','BLACKOUT STAR','3,1','1','Blackout','133000','116000','11','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT APOLO','BLACKOUT APOLO','4,1','1','Blackout','154000','135000','11','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT PEACOCK METALLIC','BLACKOUT PEACOCK METALLIC','2,75','1','Blackout','88000','79000','11','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT ASIA','BLACKOUT ASIA','1,83','1','Blackout','57000','51000','11','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT ATENAS','BLACKOUT ATENAS','2','1','Blackout','80000','72000','11','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT GLITTER (NUEVO)','BLACKOUT GLITTER (NUEVO)','2,4','1','Blackout','154000','135000','11','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT LINO (NUEVO)','BLACKOUT LINO (NUEVO)','2,4','1','Blackout','140000','122000','11','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT LISBOA','BLACKOUT LISBOA','2,4','1','Blackout','99000','89000','11','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT MOIRE','BLACKOUT MOIRE','1,83','1','Blackout','64000','57000','11','1','30');






INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLTIS 88','SOLTIS 88','1,77','1','8','165000','145000','5','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLTIS 92','SOLTIS 92','1,77','1','5','175000','154000','5','1','30');







INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN PARA EXTERIORES','SCREEN PARA EXTERIORES','3','1','3','99000','87000','17','1','30');


------------------------------------------------------------------------
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Sistema PANEL 3 Vías Blanco','Sistema PANEL 3 Vías Blanco','','2','','57000','62000','18','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Sistema PANEL 4 Vías Blanco','Sistema PANEL 4 Vías Blanco','','2','','62000','67000','18','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Sistema PANEL 5 Vías Blanco','Sistema PANEL 5 Vías Blanco','','2','','68000','74000','18','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Sistema PANEL 6 Vías Blanco','Sistema PANEL 6 Vías Blanco','','2','','75000','81000','18','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Sistema PANEL 7 Vías Blanco','Sistema PANEL 7 Vías Blanco','','2','','75000','81000','18','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('UNION RIEL 3-4-5 VIAS GALV','UNION RIEL 3-4-5 VIAS GALV','','2','','5000','','18','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('UNION RIEL 6 VIAS GALVANIZADA','UNION RIEL 6 VIAS GALVANIZADA','','2','','9200','','18','1','30');



----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR SCR 3001','SOLAR SCR 3001','1,60 - 2,00 - 2,50','1','1','72000','79000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR SCR 3003','SOLAR SCR 3003','1,60 - 2,00 - 2,50 - 3,00','1','3','67000','74000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR SCR 3005','SOLAR SCR 3005','1,60 - 2,00 - 2,50 - 3,00','1','5','60000','66000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 303','SCREEN 303','1,83 - 2,50','1','3','86000','95000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 305','SCREEN 305','1,83 - 2,50','1','5','76000','84000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 310','SCREEN 310','1,83','1','10','60000','66000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 401','SCREEN 401','1,83 - 2,50','1','1','89000','98000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 410-L','SCREEN 410-L','1,83 - 2,50 - 3,00','1','10','63000','70000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 411','SCREEN 411','1,80 - 2,50','1','11','85000','94000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 412','SCREEN 412','1,83 - 2,50 - 3,00','1','12','85000','94000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 416-L','SCREEN 416-L','1,83 - 2,50','1','16','67000','74000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 420','SCREEN 420','1,83 - 2,50','1','10','86000','95000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 425','SCREEN 425','1,83 - 2,50','1','5','72000','80000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 508 NEW CRYSTAL','SCREEN 508 NEW CRYSTAL','1,80 - 2,50','1','8','99000','109000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 511 ESPIGA','SCREEN 511 ESPIGA','1,80 - 2,50','1','11','105000','115000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 523','SCREEN 523','2,00 - 2,50','1','3','82000','90000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 550 CRISTAL','SCREEN 550 CRISTAL','1,83 - 2,50 - 3,00','1','5','87000','96000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 573 RUSTICO','SCREEN 573 RUSTICO','2,00 - 2,50 - 3,00','1','3','105000','115000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN ESTUCO','SCREEN ESTUCO','2,00 - 2,50','1','5','77000','85000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN GRANITO','SCREEN GRANITO','1,83 - 2,50','1','3','80000','88000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN JACQUARD CORCEGA','SCREEN JACQUARD CORCEGA','2,00 - 2,60','1','7','92000','101000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN JACQUARD INCANTO','SCREEN JACQUARD INCANTO','2,00 - 2,60','1','3','92000','101000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN PALMA','SCREEN PALMA','2,43','1','7','110000','120000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN PLATINUM','SCREEN PLATINUM','2,00 - 2,50','1','3','105000','115000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN RATAN','SCREEN RATAN','1,83 - 2,50','1','5','84000','93000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN REFLECTIVE','SCREEN REFLECTIVE','1,83 - 2,00 - 2,50','1','3','110000','120000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN SPIRAL','SCREEN SPIRAL','2,43','1','7','110000','120000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN WINTER','SCREEN WINTER','2,43','1','7','110000','120000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 4000','SCREEN 4000','1,83 - 2,50','1','0','94000','104000','19','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN ESTUCO CRYSTAL','SCREEN ESTUCO CRYSTAL','1,83 - 2,50','1','5','84000','93000','19','1','30');




----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR ATENAS','SOLAR ATENAS','2,00 - 2,40','1','Trasluz','52000','58000','20','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR LISBOA','SOLAR LISBOA','2,4','1','Trasluz','87000','96000','20','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR LISBOA PRINTED','SOLAR LISBOA PRINTED','2,4','1','Trasluz','90000','99000','20','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR MONACO','SOLAR MONACO','1,95','1','Trasluz','69000','76000','20','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR MUCUR','SOLAR MUCUR','2,8','1','Trasluz','66000','73000','20','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR TOKYO','SOLAR TOKYO','2,8','1','Trasluz','66000','73000','20','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR TOLEDO','SOLAR TOLEDO','2','1','Trasluz','69000','76000','20','1','30');







INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT DUAL COLOR','BLACKOUT DUAL COLOR','2,00 - 2,80','1','Blackout','89700','100000','21','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACK OUT STAR','BLACK OUT STAR','3,1','1','Blackout','140000','154000','21','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACK OUT APOLO','BLACK OUT APOLO','4,1','1','Blackout','160000','176000','21','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACK OUT PEACOCK METALLIC','BLACK OUT PEACOCK METALLIC','2,75','1','Blackout','90000','99000','21','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT ATENAS','BLACKOUT ATENAS','2','1','Blackout','80000','88000','21','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT GLITTER (NUEVO)','BLACKOUT GLITTER (NUEVO)','2,4','1','Blackout','160000','176000','21','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT LINO (NUEVO)','BLACKOUT LINO (NUEVO)','2,4','1','Blackout','140000','154000','21','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT LISBOA','BLACKOUT LISBOA','2,4','1','Blackout','99000','109000','21','1','30');







INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 3001','SCREEN 3001','89mm','4','1','69900','4000','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 3003','SCREEN 3003','89mm','4','3','65500','3800','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 3005','SCREEN 3005','89mm','4','5','59500','3600','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 303','SCREEN 303','89mm','4','3','85000','4500','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 305 L','SCREEN 305 L','89mm','4','5','75000','4000','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 310','SCREEN 310','89mm','4','10','59500','3600','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 401','SCREEN 401','89mm','4','1','87000','4500','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 410 L','SCREEN 410 L','89mm','4','10','62500','3700','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 411 L','SCREEN 411 L','89mm','4','11','84000','4500','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 412 L','SCREEN 412 L','89mm','4','12','84000','4500','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 416 L','SCREEN 416 L','89mm','4','16','65500','3800','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 420','SCREEN 420','89mm','4','10','75000','4000','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 425','SCREEN 425','89mm','4','5','72000','3800','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 508 NEW CRYSTAL','SCREEN 508 NEW CRYSTAL','89mm','4','8','99000','5000','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 511 ESPIGA','SCREEN 511 ESPIGA','89mm','4','7','105000','5000','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 523','SCREEN 523','89mm','4','3','82000','4200','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 550 CRYSTAL','SCREEN 550 CRYSTAL','89mm','4','5','86000','4500','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 573 RUSTICO','SCREEN 573 RUSTICO','89mm','4','3','105000','5000','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN ESTUCO','SCREEN ESTUCO','89mm','4','5','75000','4000','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN GRANITO','SCREEN GRANITO','89mm','4','5','75000','4200','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN JACQUARD CORCEGA','SCREEN JACQUARD CORCEGA','89mm','4','7','90000','4500','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN JACQUARD INCANTO','SCREEN JACQUARD INCANTO','89mm','4','3','90000','4500','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN PALMA','SCREEN PALMA','89mm','4','7','105000','5000','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN PLATINUM','SCREEN PLATINUM','89mm','4','3','105000','5000','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN RATAN','SCREEN RATAN','89mm','4','5','84000','4500','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN REFLECTIVE','SCREEN REFLECTIVE','89mm','4','3','105000','5500','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN SPIRAL','SCREEN SPIRAL','89mm','4','7','105000','5000','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN VISION 320','SCREEN VISION 320','89mm','4','20','57100','3500','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN VISION 350','SCREEN VISION 350','89mm','4','10','65650','3800','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN WINTER','SCREEN WINTER','89mm','4','7','105000','5000','22','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SCREEN 4000','SCREEN 4000','1,83 - 2,50','1','0','92000','5000','22','1','30');
-----------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR ATENAS','SOLAR ATENAS','89mm','4','Trasluz','50000','3600','23','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR LISBOA','SOLAR LISBOA','89mm','4','Trasluz','85000','4000','23','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR LISBOA PRINTED','SOLAR LISBOA PRINTED','89mm','4','Trasluz','88000','4000','23','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR MONACO','SOLAR MONACO','89mm','4','Trasluz','68000','3800','23','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR MUCUR','SOLAR MUCUR','89mm','4','Trasluz','64000','3800','23','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR TOKYO','SOLAR TOKYO','89mm','4','Trasluz','64000','3800','23','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SOLAR TOLEDO','SOLAR TOLEDO','89mm','4','Trasluz','68000','3800','23','1','30');



INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT DUAL COLOR','BLACKOUT DUAL COLOR','2,00 - 2,80','1','Blackout','89700','4200','24','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACK OUT PRINTED','BLACK OUT PRINTED','89mm','4','Blackout','62400','3800','24','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACK OUT TEX','BLACK OUT TEX','89mm','4','Blackout','90050','4500','24','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACK OUT STAR','BLACK OUT STAR','89mm','4','Blackout','136500','6000','24','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACK OUT APOLO','BLACK OUT APOLO','89mm','4','Blackout','154700','6600','24','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACK OUT PEACOCK METALLIC','BLACK OUT PEACOCK METALLIC','89mm','4','Blackout','90050','4500','24','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT ASIA','BLACKOUT ASIA','89mm','4','Blackout','55000','3600','24','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT ATENAS','BLACKOUT ATENAS','89mnm','4','Blackout','76200','4200','24','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT GLITTER (NUEVO)','BLACKOUT GLITTER (NUEVO)','89mm','4','Blackout','158800','6600','24','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT LINO (NUEVO)','BLACKOUT LINO (NUEVO)','89mm','4','Blackout','142950','6000','24','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT LISBOA','BLACKOUT LISBOA','89mm','4','Blackout','93100','5000','24','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BLACKOUT MOIRE','BLACKOUT MOIRE','89mm','4','Blackout','62500','3800','24','1','30');

----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHANGRI-LA CLASSIC','SHANGRI-LA CLASSIC','2,8','4','Trasluz','99900','90000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHANGRI-LA CRYSTAL','SHANGRI-LA CRYSTAL','2,8','4','Trasluz','99000','90000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG INSPIRACION','SHEER ELEG INSPIRACION','2,00 - 2,45 - 2,75','4','Trasluz','82000','74000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG NEW SANTA FE WIDE B.O.','SHEER ELEG NEW SANTA FE WIDE B.O.','2,8','4','Semi Blackout','110000','100000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG PLISADA','SHEER ELEG PLISADA','2,6','4','Trasluz','99900','90000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG PLISADA ECO','SHEER ELEG PLISADA ECO','3','4','Trasluz','88000','74000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG PLISADA WIDE','SHEER ELEG PLISADA WIDE','2,6','4','Trasluz','95000','86000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR (M.A - M.C)','SHEER ELEG SCR (M.A - M.C)','1,50 - 1,83 - 2,50 - 3,00','4','Trasluz','99900','90000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR 2T (M.A - M.C)','SHEER ELEG SCR 2T (M.A - M.C)','1,50 - 1,83 - 2,50','4','Trasluz','99900','90000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR 2T WIDE (M.A - M.C)','SHEER ELEG SCR 2T WIDE (M.A - M.C)','1,83 - 2,20 - 2,50','4','Trasluz','102500','93000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR CLASICA M.C','SHEER ELEG SCR CLASICA M.C','1,83 - 2,50','4','Trasluz','99900','90000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR COMBI 3 (M.A - M.C)','SHEER ELEG SCR COMBI 3 (M.A - M.C)','1,83 - 2,50','4','Trasluz','99900','90000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR CRYSTAL','SHEER ELEG SCR CRYSTAL','1,83 - 2,50','4','Trasluz','102500','93000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR EXTRA WIDE','SHEER ELEG SCR EXTRA WIDE','2,2','4','Trasluz','75000','68000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR TRAZOS M.C','SHEER ELEG SCR TRAZOS M.C','1,83 - 2,50','4','Trasluz','99900','90000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR WIDE (M.A - M.C)','SHEER ELEG SCR WIDE (M.A - M.C)','1,83 - 2,50','4','Trasluz','99900','93000','26','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SHEER ELEG SCR WIDE COMBI 3 (M.A - M.C)','SHEER ELEG SCR WIDE COMBI 3 (M.A - M.C)','1,83 - 2,20','4','Trasluz','99900','93000','26','1','30');

----------------------------------------------------------------


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('HANNA AFRODITA','HANNA AFRODITA','41CM','5','','124000','','27','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('HANNA ARTEMISA','HANNA ARTEMISA','41CM','5','','124000','','27','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('HANNA ATENEA','HANNA ATENEA','41CM','5','','124000','','27','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('HANNA GAIA','HANNA GAIA','41CM','5','','124000','','27','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('HANNA SELENE','HANNA SELENE','41CM','5','','124000','','27','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('HANNA MINERVA (NUEVO)','HANNA MINERVA (NUEVO)','41CM','5','','124000','','27','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('HANNA HERA (NUEVO)','HANNA HERA (NUEVO)','41CM','5','','136000','','27','1','30');


------- --------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Enrollable','Enrollable','2 m2','5','','32000','50000','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Sheer Elegance','Sheer Elegance','2 m2','5','','48000','66000','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Panel Japonés','Panel Japonés','3 m2','5','','','45200','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Romana','Romana','2 m2','5','','','51050','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Macromadera','Macromadera','2 m2','5','','99600','108.000','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Vertical','Vertical','2 m2','5','','48000','','28','1','30');

-----------------------------


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM25 R 1.1/40','DM25 R 1.1/40',' 2,40m','1','','387000','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM25 R 1.5/32','DM25 R 1.5/32','','1','','311400','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 S 6/33 -  2 ','DM 35 S 6/33 -  2 ',' 3,00m','1','','293600','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 RL 6/33 - 2 ','DM 35 RL 6/33 - 2 ','','1','','356600','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 REL 6/33 - 2 ','DM 35 REL 6/33 - 2 ','','1','','411200','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35BIELW 6/33 - 2
(Nuevo WIFI)','DM 35BIELW 6/33 - 2
(Nuevo WIFI)','','1','','486800','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 S 10/21 - 2 ','DM 35 S 10/21 - 2 ','','1','','297800','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 RL 10/21 - 2','DM 35 RL 10/21 - 2','','1','','360800','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 REL 10/21 - 2','DM 35 REL 10/21 - 2','','1','','419600','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35BIELW 10/21 - 2
(Nuevo WIFI)','DM 35BIELW 10/21 - 2
(Nuevo WIFI)','','1','','486800','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 S 10/21 - 2 ½','DM 35 S 10/21 - 2 ½','4,00m','1','','407900','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 RL 10/21 - 2 ½','DM 35 RL 10/21 - 2 ½','','1','','466200','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 REL 10/21 - 2 ½','DM 35 REL 10/21 - 2 ½','','1','','525000','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35BIELW 10/21 - 2½
(Nuevo WIFI)','DM 35BIELW 10/21 - 2½
(Nuevo WIFI)','','1','','606300','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 45 S 20/32 - 2 ½','DM 45 S 20/32 - 2 ½','','1','','474100','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 45 REQ 10/21 - 2 ½
(Nuevo)','DM 45 REQ 10/21 - 2 ½
(Nuevo)','','1','','546800','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 45 RL 20/32 - 2 ½','DM 45 RL 20/32 - 2 ½','','1','','497300','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 S 10/21 - 3 ','DM 35 S 10/21 - 3 ',' 5,00m','1','','542700','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 45 S 20/32 - 3','DM 45 S 20/32 - 3','','1','','606400','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 45 RL 20/32 - 3','DM 45 RL 20/32 - 3','','1','','636000','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 RL 10/21 - 3','DM 35 RL 10/21 - 3','','1','','605700','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 REL 10/21 - 3','DM 35 REL 10/21 - 3','','1','','664500','','28','1','30');


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35BIELW 10/21 - 3
(Nuevo WIFI)','DM 35BIELW 10/21 - 3
(Nuevo WIFI)','5,00m','1','','738600','','28','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 45 REQ 10/21 - 3
(Nuevo)','DM 45 REQ 10/21 - 3
(Nuevo)','','1','','686400','','28','1','30');




INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 45 RL 20/32 - 85mm','Motor PEL Silencioso manejado por control remoto, para tubo de 85mm (No incluye Control Remoto - hasta 21 mt2) Se pueden elaborar persianas hasta 6mt de ancho con una altura máxima de 3mt o 3,5mt de ancho por 6 mt de alto','Hasta 6,00m','1','','765500','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 45 S 20/32 - 85mm','Motor PEL Silencioso manejado por switch alámbrico, para tubo de 85mm (hasta 21mt2) Se pueden elaborar persianas hasta 3mt de ancho con una altura máxima de 6mt o 5mt de ancho por 3 mt de alto','','1','','725100','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 45 RL 20/32 -100mm','Motor PEL Silenciosos manejado por control remoto, para tubo de 100mm  (No incluye Control Remoto) Hasta  24 mt2','','1','','955900','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 45 S 20/32 - 100mm','Motor PEL Silencioso manejado por switch alámbrico, para tubo de 100mm (hasta 24mt2) Se pueden elaborar persianas hasta 3mt de ancho con una altura máxima de 6mt o 5mt de ancho por 3 mt de alto','','1','','915600','','29','1','30');

--------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DT52E','MOTOR PEL manejador por control remoto (No incluye control remoto)','Hasta 11m','1','','535900','','30','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR DM PANEL WIFI
(Nuevo)','Este motor puede automatizar por medio de una apliación desde el teléfono celular, sin necesidad de comprar otros elementos adicionales como interfases y también puede operarse desde un control remoto radio frecuencia,  (No incluye control remoto)','Hasta 11m','1','','660000','','30','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DT52E - SISTEMA COMPACTO','MOTOR PEL manejador por control remoto (No incluye control remoto): No requiere riel independiente, el motor se instala en el riel del panel.
','Hasta 11m','1','','396900','','30','1','30');


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 S 6/33','Motor PEL manejado por switch alámbrico a la pared para tubo 1 1/2 Octogonal (No incluye switch)','','1','','322900','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 RL 6/33','Motor PEL Silencioso manejado por control remoto para tubo de 1 1/2 Octogonal  (No incluye control)','','1','','392200','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 REL 6/33','Motor PEL Silencioso con límites electrónicos  manejado por control remoto para tubo 1 1/2 Octogonal - (No incluye control)','','1','','452300','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35BIELW 6/33 -
(Nuevo WIFI)','Motor WIFI PEL Silencioso con límites electrónico . Este motor se puede automatizar por medio de apliación desde el teléfono celular, sin necesidad de comprar otros elementos adicionales como interfases y también puede operarse desde un control remoto radio frecuencia,  (No incluye control remoto)','','1','','535500','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 S 10/21','Motor PEL manejado por switch alámbrico a la pared para tubo 1 1/2 Octogonal (No incluye switch)','','1','','327600','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 RL 10/21','Motor PEL Silencioso manejado por control remoto para tubo de 1 1/2 Octogonal  (No incluye control)','','1','','396900','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 REL 10/21 - 2','Motor PEL Silencioso con límites electrónicos, manejado por control remoto para tubo de 2 (no incluye control - hasta 10 mt2)','','1','','461500','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35BIELW 10/21 -
(Nuevo WIFI)','Motor WIFI PEL Silencioso con límites electrónicos . Este motor se puede automatizar por medio de apliación desde el teléfono celular, sin necesidad de comprar otros elementos adicionales como interfases y también puede operarse desde un control remoto radio frecuencia,  (No incluye control remoto)','','1','','535500','','31','1','30');
----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 S 6/33 - 2 pulgadas','Motor PEL manejado por switch alámbrico a la pared, para tubo de 2 (No incluye Switch - hasta 8mt2)','3m','1','','293600','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 RL 6/33 - 2 pulgadas','Motor PEL Silencioso manejado por control remoto para tubo de 2 (no incluye control - hasta 8 mt2)','3m','1','','356600','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 REL 6/33 - 2 pulgadas','Motor PEL Silencioso con límites electrónicos  manejado por control remoto para tubo 1 1/2 Octogonal - (No incluye control)','3m','1','','411200','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35BIELW 6/33 - 2 pulgadas
(Nuevo WIFI)','Motor WIFI PEL Silencioso con límites electrónicos,  para tubo de 2. Este motor se puede automatizar por medio de apliación desde el teléfono celular, sin necesidad de comprar otros elementos adicionales como interfases y también puede operarse desde un control remoto radio frecuencia,  (No incluye control remoto)  hasta 8 mt2','3m','1','','486800','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 S 10/21 - 2  pulgadas','Motor PEL manejado por switch alámbrico a la pared, para tubo de 2 (No incluye Switch)','3m','1','','297800','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 RL 10/21 - 2 pulgadas','Motor PEL Silencioso manejado por control remoto para tubo de 2 (no incluye control - hasta 8 mt2)','3m','1','','360800','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35 REL 10/21 - 2 pulgadas','Motor PEL Silencioso con límites electrónicos, manejado por control remoto para tubo de 2 (no incluye control - hasta 10 mt2)','3m','1','','419600','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('DM 35BIELW 10/21 - 2 pulgadas
(Nuevo WIFI)','Motor WIFI PEL Silencioso con límites electrónicos,  para tubo de 2. Este motor se puede automatizar por medio de apliación desde el teléfono celular, sin necesidad de comprar otros elementos adicionales como interfases y también puede operarse desde un control remoto radio frecuencia,  (No incluye control remoto)  hasta 10 mt2','3m','1','','486800','','32','1','30');


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Panel solar para instalación en ventana','Panel solar para instalación en ventana','','2','','194000','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Polo para 10 baterías  AA','Polo para 10 baterías  AA','','2','','23200','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Cargador 12V','Cargador 12V','','2','','34800','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('974','Switch pared vidrio DC2600','','2','','76100','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('758','Control remoto monocanal','','2','','25200','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('777','Control remoto multicanal (5 canales)','','2','','32800','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('759','Control remoto monocanal élite','','2','','52900','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('778','Control remoto multicanal élite (5 canales)','','2','','66400','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('929','Soporte central 180 graduable especial DZ318','','2','','62200','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('50235','Soporte Central  DZ318 CORTO','','2','','58800','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('773','Control led 15 canales DC 1602','','2','','126000','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('789','Control monocanal temporizado DC 1663','','2','','100800','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('47215','Interfaz motores PEL #1','','2','','650500','','33','1','30');
----------- 
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR DM 35BIE LI 6/24 2','Motor PEL recargable con batería de litio, bidireccional, con límites electrónicos, manejado por control remoto, para tubo de 2 pulgadas (el cargador y el control remoto se venden por aparte). Para fabricación de cortinas con ancho máx. de 3m y área máx. de 8m2.','3m','1','','646400','','34','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR DM 35BIE LI 6/24 2 1/2','Motor DM 35BIE LI 3/28 2 1/2 pulgadas: Motor PEL recargable con batería de litio, bidireccional, con límites electrónicos, manejado por control remoto, para tubo de 2 1/2 pulgadas (el cargador y el control remoto se venden por aparte). Para fabricación de cortinas con ancho máx. de 4m y área máx. de 10m2.','4m','1','','759700','','34','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR DM 35BIE LI 6/24 3','Motor DM 35BIE LI 3/28 2 1/2 pulgadas: Motor PEL recargable con batería de litio, bidireccional, con límites electrónicos, manejado por control remoto, para tubo de 3 pulgadas (el cargador y el control remoto se venden por aparte). Para fabricación de cortinas con ancho máx. de 5m y área máx. de 15m2.','5m','1','','888000','','34','1','30');


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('47217','Control remoto monocanal  para motor DM 35BIE LI (Recargables y WIFI)','','2','','84000','','35','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('47218','Control remoto 15 canales  para motor DM 35BIE LI (Recargables y WIFI)','','2','','88200','','35','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('54054','Cargador DM 8V  para  motor DM  35 E LI 6/24','','2','','27600','','35','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('24001','Soporte central R16 S corto ( para tubo 1 -1/2)','','2','','7000','','35','1','30');


----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR PX 25 REL LI 1,1/30 1 1/2 pulgada','Motor PX 25 REL LI 1,1/30 1 1/2 pulgada: Motor PEL recargable con batería de litio, silencioso, con límites electrónicos, manejado por control remoto, para tubo de 1 1/2 pulgada (el cargador y el control remoto se venden por separado). Para fabricación de cortinas con ancho máx. de 2,4m y área máx. de 6m2.','2,4m','2','','294400','','36','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR PX35 RELW 5/22 - 2 pulgada (Nuevo WIFI)','Motor WIFI PEL Silencioso con límites electrónicos,  para tubo de 2 pulgada. Este motor se puede automatizar por medio de apliación desde el teléfono celular, sin necesidad de comprar otros elementos adicionales como interfases y también puede operarse desde un control remoto radio frecuencia,  (No incluye control remoto)  hasta 8 mt2','3m','2','','486800','','36','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR PX35 RELW
5/22 - 2½ pulgada (Nuevo WIFI)','Motor WIFI PEL Silencioso con límites electrónicos,  para tubo de 2 1/2 pulgada. Este motor se puede automatizar por medio de apliación desde el teléfono celular, sin necesidad de comprar otros elementos adicionales como interfases y también puede operarse desde un control remoto radio frecuencia,  (No incluye control remoto)  hasta 9 mt2','4m','2','','606300','','36','1','30');


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR PANEL PX','Manejador por control remoto radio frecuencia y/o switch alámbrico (No incluye control remoto) especial para automatización','11m','2','','465300','','44','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR PANEL PX - WIFI
(Nuevo)','Este motor puede automatizar por medio de una apliación desde el teléfono celular, sin necesidad de comprar otros elementos adicionales como interfases y también puede operarse desde un control remoto radio frecuencia,  (No incluye control remoto)','11m','2','','427800','','44','1','30');


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR PX 25 REL LI 1,1/30 1 1/2 pulgada','Motor PX 25 REL LI 1,1/30 1 1/2 pulgada: Motor PEL recargable con batería de litio, silencioso, con límites electrónicos, manejado por control remoto, para tubo de 1 1/2 pulgada (el cargador y el control remoto se venden por separado). Para fabricación de cortinas con ancho máx. de 2,4m y área máx. de 6m2. SOLO APLICA PARA ROMANA','2,4m','2','','323900','','45','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR PX35 RELW 5/22 - 2 pulgada (Nuevo WIFI)','Motor WIFI PEL Silencioso con límites electrónicos,  para tubo de 2 pulgada. Este motor se puede automatizar por medio de apliación desde el teléfono celular, sin necesidad de comprar otros elementos adicionales como interfases y también puede operarse desde un control remoto radio frecuencia,  (No incluye control remoto)  hasta 8 mt2','3m','2','','535500','','45','1','30');


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR PX 25 REL LI 1,1/30 1 1/2 pulgada','Motor PX 25 REL LI 1,1/30 1 1/2 pulgada: Motor PEL recargable con batería de litio, silencioso, con límites electrónicos, manejado por control remoto, para tubo de 1 1/2 pulgada (el cargador y el control remoto se venden por separado). Para fabricación de cortinas con ancho máx. de 2,4m y área máx. de 6m2.','2,4m','2','','294400','','46','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOTOR PX35 RELW 5/22 - 2 pulgada (Nuevo WIFI)','Motor WIFI PEL Silencioso con límites electrónicos,  para tubo de 2 pulgada. Este motor se puede automatizar por medio de apliación desde el teléfono celular, sin necesidad de comprar otros elementos adicionales como interfases y también puede operarse desde un control remoto radio frecuencia,  (No incluye control remoto)  hasta 8 mt2','3m','2','','486800','','46','1','30');


----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('47589','Control remoto 6 canales  para motor PANEL PX','','2','','50400','','37','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('47585','Cargador PX para motor R25V REL LI 1,1/30','','2','','16800','','37','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('24001','Soporte central R16 S corto ( para tubo 1 -1/2)','','2','','7000','','37','1','30');

----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 35 R-EL 6/28 - 2  pulgada','Motor PEL Silencioso con límites electrónicos para tubo de 2 pulgada (No incluye control Hasta 8 mt2)','3m','2','','325400','','48','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 35 S-EL 6/28 - 2  pulgada (Nuevo)','Motor PEL manejado por switch alámbrico a la pared para tubo de 2 pulgada (No incluye switch -Hasta 8 mt2)','3m','2','','279200','','48','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 45 R-EL 15/28 - 2 ½ pulgada','Motor PEL Silencioso con límites electrónicos manejado por control remoto para tubo de 2 ½ pulgada (No incluye control - hasta 15mt²) Se pueden elaborar persianas hasta 4mt de ancho con una altura máxima de 3mt o 3mt de ancho con una altura de 5mt','4m','2','','476300','','48','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 45 R-EL 15/28 - 3  pulgada','Motor PEL Silencioso  con límites electrónicos manejado por control remoto para tubo de 3 pulgada (No incluye control - hasta 18 mt²) Se pueden elaborar persianas hasta 3mt de ancho con una altura máxima de 6mt o 5mt de ancho con una altura de 3mt','5m','2','','601900','','48','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 45 R-EL 15/28 - 85mm','Motor PEL Silencioso  con límites electrónicos manejado por control remoto para tubo de 85mm (No incluye control - Hasta 21m2) Se pueden elaborar persianas hasta 3.5 mt de ancho con una altura
máxima de 6mt o 6mt de ancho con una altura de 3mt','6m','2','','760400','','48','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 45 R-EL 15/28 - 100mm','Motor PEL Silencioso con límites electrónicos manejado por control remoto para tubo de 85mm (No incluye control - Hasta 21m2) Se pueden elaborar persianas hasta 3.5 mt de ancho con una altura
máxima de 6mt o 6mt de ancho con una altura de 3mt','6m','2','','950900','','48','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 35 R-EL 6/28','Motor PEL Silencioso límites electrónicos manejado por control remoto para tubo de 1 ½ pulgada y 2 pulgada (No incluye control) (Hasta 10m2)','','2','','325400','','32','1','30');

----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 25 DB','Motor PEL manejado por control Remoto y/o switch  alámbrico (NO incluye control remoto) especial para automatización conexión RS232 - RS485.','11m','2','','457600','','30','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 18,9 DB','Motor PEL Silencioso manejado por control Remoto y/o switch inalámbrico (NO incluye control remoto) especial para automatización conexión RS232 - RS485.','11m','2','','502700','','30','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 25 DB - sistema compacto (nuevo)
','Motor PEL manejado por control Remoto y/o switch  inalámbrico (NO incluye control remoto) especial para automatización conexión RS232 - RS485. No requiere riel independiente, el motor se instala en el riel del panel.','11m','2','','325100','','30','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 18,9 DB - sistema compacto (nuevo)
','Motor PEL Silencioso manejado por control Remoto y/o switch alámbrico (NO incluye control remoto) especial para automatización conexión RS232 - RS485.  No requiere riel independiente, el motor se instala en el riel del panel.','11m','2','','367200','','30','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('PEL 35 R-EL 6/28','Motor PEL Silencioso con límites electrónicos manejado por control remoto para tubo de 1 ½ (No incluye control)','','2','','361200','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('33552','Control remoto multicanal (5 canales) NEW LINE','','2','','','','49','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('8842','Control remoto multicanal (9 canales) NEW LINE','','2','','','','49','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('8846','Botonera central inalámbrica para pared PEL (para conexión por contacto seco)','','2','','','','49','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('8826','Soporte intermedio para cortinas motorizadas (Solo enrollables) 2','','2','','','','49','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('8827','Soporte intermedio para cortinas motorizadas (Solo enrollables) 2-1/2','','2','','','','49','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('8828','Soporte intermedio Largo para cortinas motorizadas (Solo enrollables) 2-1/2','','2','','','','49','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('25898','Soporte intermedio  Largo para cortinas motorizadas (Solo enrollables) 85mm','','2','','','','49','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('54369','Interfaz motor PEL # 2','','2','','','','49','1','30');
----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Motor PV 25 RE LI 1,1/26 1 1/2: Motor PEL recargable con batería de litio, con límites electrónicos, manejado por control remoto, para tubo de 1 1/2 (el cargador y el control remoto se venden por separado). Para fabricación de cortinas con ancho máx. de 2,4m y área máx. de 6m2.','291600','','2','','','','50','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Motor PV 25 E LI 1,1/26 1 1/2: Motor PEL recargable con batería de litio, con límites electrónicos, manejado por control alámbrico tipo bastón, para tubo de 1 1/2 (el cargador se venden por separado). Para fabricación de cortinas con ancho máx. de 2,4m y área máx. de 6m2.','263600','','2','','','','50','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Motor panel PV 18,9 DB LI: Motor PEL silencioso, recargable con batería de litio, manejado por control remoto (el cargador y el control remoto), especial para automatización conexión RS485 - RS232.','628400','','2','','','','50','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Motor panel PV 18,9 DB LI: Motor PEL silencioso, recargable con batería de litio, manejado por control remoto (el cargador y el control remoto se venden por aparte), especial para automatización conexión RS485 - RS232.No requiere riel independiente, el motor se instala en el riel del panel.','490700','','2','','','','50','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('47591','Control  remoto multicanal (5 canales)  PV MOTOR LI','','2','','41100','','51','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('47588','Cargador para motor panel PV 16.8V MOTOR PV 18,9DB LI','','2','','27600','','51','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('47587','Cargador para motor PV 5V MOTOR 25 E LI 1,1/26','','2','','27600','','51','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('47586','Cargador para motor PV 9V MOTOR 25 RE LI 1,1/26','','2','','27600','','51','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('24001','Soporte central R16 S corto ( para tubo 1 -1/2)','','2','','7000','','51','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('55155','Interfaz motor recargable PEL # 2','','2','','176400','','51','1','30');



----------------------------------------------------------------
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ROLL UP 28 1,5/35 12V','MOTOR PARA ENROLLABLE BATERÍA 12 VOL. - NO INCLUYE CONTROL REMOTO','','2','','Precio bajo pedido','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ST 30 R 2/20','MOTOR SOMFY SONESSE 30 R 2/20 LI-ION','','2','','758900','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LT 28 R-1,5/28','MOTOR SOMFY ALTUS 20 R 1,5/28 LI-ION','','2','','689000','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Sonesse 30 R 2/28','MOTOR SONESSE 30 RTS 433MHZ 2/28','','2','','Precio bajo pedido','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ST 40 S 4/36 - 2 pulgada','MOTOR 404 SONESSE SWITCHADO  110 VOL. - NO INCLUYE SWITCH - PARA TUBO DE 2 pulgada','','2','','708200','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ST 40 R 4/36 - 2 pulgada','MOTOR 404 SONESSE RTS 110 VOL. - NO INCLUYE CONTROL - PARA TUBO DE 2 pulgada','','2','','953500','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ST 40 S 6/24 - 2 pulgada','MOTOR 406A2 SONESSE SWITCHADO  110 VOL. - NO INCLUYE SWITCH - PARA TUBO DE 2 pulgada','','2','','736900','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ST 40 R 6/24 - 2 pulgada','MOTOR 406A2 SONESSE RTS 110 VOL. - NO INCLUYE CONTROL  - PARA TUBO DE 2 pulgada','','2','','969000','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LSN 40 S 6/33 L - 2 pulgada','MOTOR 406 LSN SWITCHADO  LIMITES MECÁNICOS 110 VOL. - NO INCLUYE SWITCH - PARA TUBO DE 2 pulgada','','2','','428700','','29','1','30');
----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LSN  40 R 6/33 L - 2 pulgada','MOTOR 406 LSN RADIOFRECUENCIA LIMITES ELECTRÓNICOS 110 VOL.- PARA TUBO DE 2 pulgada','','2','','558700','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LSN 40 S 6/33 L - 2 1/2 pulgada','MOTOR 406 LSN SWITCHADO  LIMITES MECÁNICOS 110 VOL. - NO INCLUYE SWITCH - PARA TUBO DE 2 1/2 pulgada','','2','','536300','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LSN  40 R 6/33 L - 2 1/2 pulgada','MOTOR 406 LSN RADIOFRECUENCIA LIMITES ELECTRÓNICOS 110 VOL.- PARA TUBO DE 2 1/2 pulgada','','2','','666300','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LT 50 S  6/38 - 2 1/2 pulgada','MOTOR PARA ENROLLABLESUICHADO110 VOL. - NO INCLUYE SWITCH','','2','','757600','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LT 50 S  6/38 - 3 pulgada','MOTOR PARA ENROLLABLESUICHADO110 VOL. - NO INCLUYE SWITCH','','2','','923600','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LT 50 R  6/38 - 2 1/2 pulgada','MOTOR PARA ENROLLABLE RADIOFRECUENCIA 110 VOL. - NO INCLUYE CONTROL REMOTO','','2','','983500','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LT 50 R  6/38 - 3 pulgada','MOTOR PARA ENROLLABLE RADIOFRECUENCIA 110 VOL. - NO INCLUYE CONTROL REMOTO','','2','','1149500','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LT 50 R 10/38 - 2 1/2 pulgada','MOTOR PARA ENROLLABLE RADIOFRECUENCIA 110 VOL. - NO INCLUYE CONTROL REMOTO','','2','','1153600','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LT 50 R 10/38 - 3 pulgada','MOTOR PARA ENROLLABLE RADIOFRECUENCIA 110 VOL. - NO INCLUYE CONTROL REMOTO','','2','','1326500','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LT 50 R 10/38 - 85mm pulgada','MOTOR PARA ENROLLABLE RADIOFRECUENCIA 110 VOL. - NO INCLUYE CONTROL REMOTO','','2','','1434800','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LT 50 R 10/38 - 100mm pulgada','MOTOR PARA ENROLLABLE RADIOFRECUENCIA 110 VOL. - NO INCLUYE CONTROL REMOTO','','2','','1689800','','29','1','30');

-- --------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ST 40 S 4/36 - 2','MOTOR 404 SONESSE SWITCHADO  110 VOL. - NO INCLUYE SWITCH - PARA TUBO DE 2','','2','','708200','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ST 40 R 4/36 - 2','MOTOR 404 SONESSE RTS 110 VOL. - NO INCLUYE CONTROL - PARA TUBO DE 2','','2','','953500','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ST 40 S  6/24 - 2','ST40  SWITCHADO SILENCIOSO 110 VOL. - NO INCLUYE SWITCH','','2','','736900','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ST 40 R  6/24 - 2','ST40  RADIOFRECUENCIA 50mm SILENCIOSO 110 VOL. - NO INCLUYE CONTROL REMOTO','','2','','969000','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LSN 40 S 6/33 - 2','MOTOR 406 LSN SWITCHADO  LIMITES MECÁNICOS 110 VOL. - NO INCLUYE SWITCH','','2','','428700','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LSN 40 R 6/33 - 2','MOTOR 406 LSN RADIOFRECUENCIA LÍMITES ELECTRÓNICOS 110 VOL. - NO INCLUYE SWITCH','','2','','558700','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('MOVELITE','MOTOR PEL manejador por control remoto (No incluye control remoto), riel hasta 6 metros de ancho','','2','','1102300','','30','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ST 40 S  6/24','ST40 PARA ROMANA O MACROMADERA SWITCHADO 50mm SILENCIOSO 110 VOL. - NO INCLUYE SWITCH','','2','','823600','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ST 40 R  6/24','ST40 PARA ROMANA O MACROMADERA RADIOFRECUENCIA 50mm SILENCIOSO 110 VOL. - NO INCLUYE CONTROL REMOTO','','2','','1040200','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LSN 40 S 6/33','MOTOR SUICHADO LIMITES MECÁNICOS, NO INCLUYE SWITCH','','2','','516200','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('LSN 40 R 6/33','MOTOR RADIOFRECUENCIA LÍMITES ELECTRÓNICOS, NO INCLUYE CONTROL REMOTO','','2','','646200','','31','1','30');


----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('BATERIA NO RECARGABLE 12 VOLT SENCILLA  PARA ROLL UP 28 1,5/35 12V','BATERIA NO RECARGABLE 12 VOLT SENCILLA  PARA ROLL UP 28 1,5/35 12V','','2','','Precio bajo pedido','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('TRANSFORMADOR DE 24 VOLT - DC / 2 AMP PARA','TRANSFORMADOR DE 24 VOLT - DC / 2 AMP PARA','','2','','Precio bajo pedido','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('CABLE Y CARGADOR PARA MOTORES LI-ION','CABLE Y CARGADOR PARA MOTORES LI-ION','','2','','60800','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('769','CONTROL REMOTO MONOCANAL TELIS 1 BLANCO','','2','','109200','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('32584','CONTROL SITUO 1 BLANCO','','2','','109200','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('23287','CONTROL SITUO 5 BLANCO','','2','','190800','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('766','CONTROL MONOCANAL DE PARED SMOOVE RTS','','2','','144400','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('779','CONTROL REMOTO MODULIS MULTICANAL  (Función para motores ST40) - BLANCO','','2','','224000','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('765','CONTROL REMOTO PATIO MONOCANAL (Uso con Sensores) - BLANCO','','2','','Precio bajo pedido','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('CONTROL REMOTO PATIO MULTICANAL (Uso con Sensores) - BLANCO','CONTROL REMOTO PATIO MULTICANAL (Uso con Sensores) - BLANCO','','2','','Precio bajo pedido','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('786','CONTROL TEMPORIZADOR TELIS 6 CHRONIS RTS BATERIAS AAA - 6 CANALES - 6 HORARIOS .- BLANCO','','2','','Precio bajo pedido','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('775','CONTROL REMOTO TELIS 16 RTS BLANCO (16 CANALES)','','2','','564400','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('923','SENSOR SOLAR SUNIS (USO EXTERIOR)','','2','','776600','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('SENSOR VIENTO','SENSOR VIENTO','','2','','417800','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('801','INTERFACE UNIVERSAL RS485 A RADIO','','2','','Precio bajo pedido','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('76149','INTERFACE UNIVERSAL RTS - 16 CANALES (para RS 232, RS 485 y contecto  seco)','','2','','799500','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('FUENTE INTERFAZ 9 V','FUENTE INTERFAZ 9 V','','2','','71900','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('803','INTERFACE Z / WAVE','','2','','Precio bajo pedido','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('6433','INTEO','','2','','500500','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('933','SOPORTE INTERMEDIO PARA LT50 (Diámetro 50 mm)','','2','','Precio bajo pedido','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('RECEPTOR CENTRALIS INTERIOR - 110V','RECEPTOR CENTRALIS INTERIOR - 110V','','2','','442000','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('921','RECEPTOR EXTERIOR RTS UNIVERSAL - 110V','','2','','383100','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('RECEPTOR RTS DE 24 VDC','RECEPTOR RTS DE 24 VDC','','2','','Precio bajo pedido','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('922','REPETIDOR RTS 120VAC 60HZ','','2','','1023600','','33','1','30');


-- --------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ROLLER 64 40MM','Motor ideal para ventanas de tamaño pequeño o mediano, ensamble en tubo de 40mm, para cortinas hasta 2,44m de ancho y 6,0 m2. Ancho mínimo 0,50m. Motor de límites electrónicos, ultra silencioso, desplazamiento más preciso. Para uso por medio de control remoto por radiofrecuencia, se debe adquirir por separado, la antena Lutron y el control remoto Lutron pico. Para la alimentación de corriente del motor, debe adquirir la fuente del motor por separado y el conector fuente.','','2','','1803600','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ROLLER 100 2 1/2 pulgada','Motor ideal para ventanas de tamaño mediano, ensamble en tubo de 2 1/2 pulgada, para cortinas hasta 3,05m de ancho y 9,3 m2. Ancho mínimo 0,65m. Motor de límites electrónicos, ultra silencioso, desplazamiento más preciso. Para uso por medio de control remoto por radiofrecuencia, se debe adquirir por separado, la antena Lutron y el control remoto Lutron pico. Para la alimentación de corriente del motor, debe adquirir la fuente del motor por separado.','','2','','2014700','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ROLLER 150 2 1/2 pulgada','Motor ideal para ventanas altas, ensamble en tubo de 2 1/2 pulgada, para cortinas hasta 3,5m de ancho y 14 m2. Ancho mínimo 0,65m. Motor de límites electrónicos, ultra silencioso, desplazamiento más preciso. Para uso por medio de control remoto por radiofrecuencia, se debe adquirir por separado, la antena Lutron y el control remoto Lutron pico. Para la alimentación de corriente del motor, debe adquirir la fuente del motor por separado.','','2','','2212800','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ROLLER 300 2 1/2 pulgada','Motor ideal para ventanas altas y anchas, ensamble en tubo de 2 1/2 pulgada, para cortinas hasta 4,60m de ancho y 28 m2. Ancho mínimo 0,65m. Motor de límites electrónicos, silencioso, desplazamiento más preciso. Para uso por medio de control remoto por radiofrecuencia, se debe adquirir por separado, la antena Lutron y el control remoto Lutron pico. Para la alimentación de corriente del motor, debe adquirir la
fuente del motor por separado.','','2','','2463400','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ROLLER 150 3 pulgada','Motor ideal para ventanas altas, ensamble en tubo de 2 1/2 pulgada, para cortinas hasta 5m de ancho y 14 m2. Ancho mínimo 0,65m. Motor de límites electrónicos, ultra silencioso, desplazamiento más preciso. Para uso por medio de control remoto por radiofrecuencia, se debe adquirir por separado, la antena Lutron y el control remoto Lutron pico. Para la alimentación de corriente del motor, debe adquirir la fuente del motor
por separado.','','2','','2320300','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ROLLER 300 3 pulgada','Motor ideal para ventanas altas y anchas, ensamble en tubo de 2 1/2 pulgada, para cortinas hasta 5m de ancho y 28 m2. Ancho mínimo 0,65m. Motor de límites electrónicos, silencioso, desplazamiento más preciso. Para uso por medio de control remoto por radiofrecuencia, se debe adquirir por separado, la antena Lutron y el control remoto Lutron pico. Para la alimentación de corriente del motor, debe adquirir la fuente del motor
por separado.','','2','','2570900','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ACOPLE -40MM','El acople incluye accesorios de motorización para 40mm','','2','','42600','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ACOPLE -2 1/2 pulgada','El acople incluye accesorios de motorización para 2 1/2 pulgada','','2','','163900','','29','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ACOPLE -3 pulgada','El acople incluye accesorios de motorización para 3 pulgada','','2','','269100','','29','1','30');


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ROLLER 64 40MM','Motor ideal para ventanas de tamaño pequeño o mediano, ensamble en tubo de 40mm, para cortinas hasta 2,44m de ancho y 6,0 m2. Ancho mínimo 0,50m. Motor de límites electrónicos, ultra silencioso, desplazamiento más preciso. Para uso por medio de control remoto por radiofrecuencia, se debe adquirir por separado, la antena Lutron y el control remoto Lutron pico. Para la alimentación de corriente del motor, debe adquirir la fuente del motor por separado.','','2','','1803600','','32','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ACOPLE -40MM','El acople incluye accesorios de motorización para 40mm','','2','','42600','','32','1','30');
----------------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('D - 105','Motor para riel de panel o cortina contemporánea, hasta 47,6 Kg de peso en tela y 6 metros de ancho. ultra silencioso. Para uso por medio de control remoto por radiofrecuencia, se debe adquirir por separado, la antena Lutron y el control remoto Lutron pico. Para la alimentación de corriente del motor, debe adquirir la fuente del motor por separado.','','2','','2775500','','30','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('METRO ADICIONAL RIEL
LUTRON','Incluye soportes de instalación y una unión de riel.','','2','','58400','','30','1','30');


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ROLLER 64 40MM','Motor ideal para ventanas de tamaño pequeño o mediano, ensamble en tubo de 40mm, para cortinas hasta 2,44m de ancho y 6,0 m2. Ancho mínimo 0,50m. Motor de límites electrónicos, ultra silencioso, desplazamiento más preciso. Para uso por medio de control remoto por radiofrecuencia, se debe adquirir por separado, la antena Lutron y el control remoto Lutron pico. Para la alimentación de corriente del motor, debe adquirir la fuente del motor por separado.','','2','','1983960','','31','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('ACOPLE -40MM','El acople incluye accesorios de motorización para 40mm','','2','','46860','','31','1','30');


INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('724','ANTENA RF LUTRON','','2','','700700','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('733','CONECTOR DE FUENTE','','2','','30300','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('6031','CTRL REM 4 ZONAS RF','','2','','485100','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('736','CTRL REMOTO LUTRON PICO','','2','','238500','','33','1','30');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('797','FUENTE DE PODER','','2','','300800','','33','1','30');

-- --------------------------------

ALTER TABLE productos
ADD pasadores tinyint;

ALTER TABLE productos
ADD cerradura varchar(200);

ALTER TABLE productos
ADD llaves varchar(200);

ALTER TABLE productos
ADD tipo_seguridad varchar(200);

-- --------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`,`pasadores`, `cerradura`, `llaves`, `tipo_seguridad`) VALUES ('Italiana','Hoja puerta en lamina calibre 14 con refuerzos internos, marco en lamina calibre 14 anclado y fundido en concreto. Enchapado en madera *conservando el
diseño de propiedad horizontal *','','2','','5000000','','2','1','30','13','Italiana','5 llaves usuario y 1
de servicio','Aleta de seguridad anti palanca - 3 bisagras tipo caja fuerte - pasador nocturno ');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`,`pasadores`, `cerradura`, `llaves`, `tipo_seguridad`) VALUES ('Italiana 4K','Hoja puerta en lamina calibre 14 con refuerzos internos, marco en lamina calibre 14 anclado y fundido en concreto. Enchapado en madera *conservando el
diseño de propiedad horizontal *','','2','','5500000','','2','1','30','13','Italiana + 1 Adicional Viajera','5 llaves usuario y 1
de servicio','Aleta de seguridad anti palanca - 3 bisagras tipo caja fuerte - pasador nocturno ');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`,`pasadores`, `cerradura`, `llaves`, `tipo_seguridad`) VALUES ('Israeli','Hoja puerta en lamina calibre 14 con refuerzos internos, marco en lamina calibre 14 anclado y fundido en concreto. Enchapado en madera *conservando el
diseño de propiedad horizontal *','','2','','6000000','','2','1','30','13','Israelí','5 llaves
codificadas con  restricción de
copia','Aleta de seguridad anti palanca - 3 bisagras tipo caja fuerte - pasador nocturno ');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`,`pasadores`, `cerradura`, `llaves`, `tipo_seguridad`) VALUES ('Americana','Hoja puerta en lamina calibre 14 con refuerzos internos, marco en lamina calibre 14 anclado y fundido en concreto. Enchapado en madera *conservando el
diseño de propiedad horizontal *','','2','','6500000','','2','1','30','13','USA AMERICANA MUL-T-LOCK ','5
llaves de usuario con restricción de copia','Aleta de seguridad anti palanca - 3 bisagras tipo caja fuerte - pasador nocturno ');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`,`pasadores`, `cerradura`, `llaves`, `tipo_seguridad`) VALUES ('China','Hoja puerta en lamina calibre 14 con refuerzos internos, marco en lamina calibre 14 anclado y fundido en concreto. Enchapado en madera *conservando el
diseño de propiedad horizontal *','','2','','7000000','','2','1','30','13','ADEL-TTLOCK-SAMSUNG-ISEOMULTI-
LOCK','200 claves - apertura por app - 1 pasador de seguridad - compatible con Alexa y home domótica','Aleta de seguridad anti palanca - 3 bisagras tipo caja fuerte');


--  --------------------------------------------------------

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`,`pasadores`, `cerradura`, `llaves`, `tipo_seguridad`) VALUES ('Tetra','4','','2','','300000','','54','1','30','4','3','5 llaves tetra','Escudo anti ganzuda');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`,`pasadores`, `cerradura`, `llaves`, `tipo_seguridad`) VALUES ('Anti taladro','3','','2','','420000','','54','1','30','3','2','5 llaves codificadas','Escudo anti taladro');



INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`,`pasadores`, `cerradura`, `llaves`, `tipo_seguridad`) VALUES ('Seguridad 1','4+1','','2','','1600000','','55','1','30','4+1','4','Digital','Clave, huella, app y llave');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`,`pasadores`, `cerradura`, `llaves`, `tipo_seguridad`) VALUES ('Seguridad 2','4+1','','2','','2000000','','55','1','30','4+1','4','Digital','Clave, huella,app y tarjeta');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`,`pasadores`, `cerradura`, `llaves`, `tipo_seguridad`) VALUES ('Seguridad 3','4+1','','2','','2100000','','55','1','30','4+1','4','Digital','Clave, huella,app y cámara');
INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`,`pasadores`, `cerradura`, `llaves`, `tipo_seguridad`) VALUES ('Seguridad total','4+1','','2','','2400000','','55','1','30','4+1','6','Digital','Clave, huella,app, cámara, tarjeta y llave');


-------------------------------------------------------

CREATE TABLE cotizacion (
	id_cotizacion bigint AUTO_INCREMENT PRIMARY KEY,
    negocio_id bigint not null,
    usuario_id bigint not null,
    fecha_registro datetime not null,
    FOREIGN KEY (negocio_id) REFERENCES negocios(id_negocio),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_user)
);

CREATE TABLE cotizacion_detalle(
	id_cotizacion_detalle bigint AUTO_INCREMENT PRIMARY KEY,
    cotizacion_id bigint not null,
	producto_id bigint not null,
    cant_producto int not null,
    precio_producto bigint not null,
    FOREIGN KEY (cotizacion_id) REFERENCES cotizacion(id_cotizacion),
    FOREIGN KEY (producto_id) REFERENCES productos(id_producto)
);

create table correo_notificacion_cotizacion(
	id_notificacion bigint AUTO_INCREMENT PRIMARY KEY,
    cotizacion_id bigint not null,
    usuario_id bigint not null,
    fecha_envio datetime not null,
    FOREIGN KEY (cotizacion_id) REFERENCES cotizacion(id_cotizacion),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_user)
);

----------------------------------------------------------

CREATE TABLE negocios (
	id_negocio bigint AUTO_INCREMENT PRIMARY KEY,
    solicitud_id bigint not null,
    cliente_id bigint null,
    fecha_registro datetime not null,
    user_crea bigint not null,
    estado tinyint null,
    FOREIGN KEY (solicitud_id) REFERENCES solicitudes_prospecto(id_solicitud),
    FOREIGN KEY (cliente_id) REFERENCES clientes(id_cliente),
	FOREIGN KEY (user_crea) REFERENCES usuarios(id_user)
);
alter table negocios
add observacion varchar(2000);

create table etapas_negocio
(
	id_etapa int AUTO_INCREMENT PRIMARY KEY,
    etapa varchar(100) not null
);

INSERT INTO `etapas_negocio`(`etapa`) VALUES ('Información Cliente');
INSERT INTO `etapas_negocio`(`etapa`) VALUES ('Solicitud Cliente');
INSERT INTO `etapas_negocio`(`etapa`) VALUES ('Cotización');
INSERT INTO `etapas_negocio`(`etapa`) VALUES ('Agendamiento Instalación');
INSERT INTO `etapas_negocio`(`etapa`) VALUES ('Terminación de Negocio');
INSERT INTO `etapas_negocio`(`etapa`) VALUES ('Encuesta de Satisfacción');

create table negocios_historial_etapas
(
	id_historial bigint AUTO_INCREMENT PRIMARY KEY,
	negocio_id bigint not null,
    etapa_id int not null,
	user_id bigint not null,
	fecha datetime not null,
	FOREIGN KEY (etapa_id) REFERENCES etapas_negocio(id_etapa),
    FOREIGN KEY (user_id) REFERENCES usuarios(id_user),
	FOREIGN KEY (negocio_id) REFERENCES negocios(id_negocio)
);

CREATE TABLE negocios_solicitud_cliente (
	id_solicitud_negocio bigint AUTO_INCREMENT PRIMARY KEY,
    negocio_id bigint not null,
    observacion varchar(2000)not null,
    fecha_registro datetime not null,
    user_crea bigint not null,
    FOREIGN KEY (negocio_id) REFERENCES negocios(id_negocio),
	FOREIGN KEY (user_crea) REFERENCES usuarios(id_user)
);