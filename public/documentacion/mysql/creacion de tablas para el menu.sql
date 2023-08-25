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
   usuario_registro varchar(100) not null,
   fecha_registro datetime not null,
   FOREIGN KEY (id_tercero) REFERENCES terceros(id)
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
VALUES ('Soporte central con bujes para 2 enrollables tubo 1 1/2"','Soporte central con bujes para 2 enrollables tubo 1 1/2"','3','1','','7700','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Perfil lateral para oscuridad total (incluye felpa interna)','Perfil lateral para oscuridad total (incluye felpa interna)','1','1','','12500','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Perfil lateral enrollable blanco especial para oscuridad total Cortinas motorizadas','Perfil lateral enrollable blanco especial para oscuridad total Cortinas motorizadas','1','1','','18000','','7','1','30');

INSERT INTO `productos`(`referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`) 
VALUES ('Tubo Acero inox 1" - incluye bujes plásticos laterales (Especial para toldo vertical PEL)','Tubo Acero inox 1" - incluye bujes plásticos laterales (Especial para toldo vertical PEL)','1','1','','35000','','7','1','30');

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







