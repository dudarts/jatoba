<?php
class Conexao extends MySQLi {

	private static $host = 'localhost';
	private static $user = '';
	private static $pass = '';
	private static $base = 'widok';

	private static $conectado = false;
	private static $instaciado = NULL;
	
	public function __destruct(){
		$this->close();	
	}
	
	public static function getInstanciar() {
		if (NULL == self::$instaciado){
			self::$instaciado = new self();	
		}
		return self::$instaciado;
	}
	
	public function conectar(){
		if (!self::$conectado) {
			parent::__construct(self::$host, self::$user, self::$pass, self::$base);
		parent::set_charset('utf8');
			
			if (mysqli_connect_errno()) {
				throw new Exception('A conexao falho: ' . mysqli_connect_error());	
			}
			self::$conectado = true;
		}
	}
	
	public function fechar(){
		if (self::$conectado) {
			parent::close();
			self::$conectado = false;	
		}
	}
	
	public function executar($pSQL, $pMostraSql = false) {
		$this->conectar();
		$resultado = parent::query($pSQL);

		if ($pMostraSql) {
			echo '<b>Erro na Query:</b><br>' . $pSQL;
			echo '<br><br>';
		}

		if ($resultado) {
			return $resultado;	
		} else {
			echo '<b>Erro:</b><br>' . mysqli_error($this); 	
			echo '<br><br>';
			echo '<b>Número:</b>' . mysqli_errno($this) . '<br><br>'; 	
		}
	}
	
	public function estado(){
		if (@mysqli_ping($this)){
			return true;
		} else {
			return false;	
		}
	}
}
?>