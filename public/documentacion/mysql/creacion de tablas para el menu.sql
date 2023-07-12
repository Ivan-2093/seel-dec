--CREACIÓN DE TABLAS
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

