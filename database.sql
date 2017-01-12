CREATE TABLE IF NOT EXISTS usuarios(
	usuarioId int(11) PRIMARY KEY AUTO_INCREMENT,
  	username varchar(100) NOT NULL,
 	password varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


INSERT INTO usuarios(username,password) VALUES('usuario','inseguro');

