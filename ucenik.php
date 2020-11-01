<?php

class Ucenik
{

	private $id;
	private $datum_upisa;

	private $ime;
	private $prezime;
	private $datum_rodjenja;
	private $telefon;

	private $kursevi;

	public function __construct()
	{
	}

	public function ubaciUcenike($data, $db)
	{
		if ($data['ime'] === '' || $data['prezime'] === '' || $data['kurs'] === '') {
			$this->poruka = 'Polja moraju biti popunjena';
		}

		$sacuvano = $db->insert('ucenik', $data);
		if ($sacuvano) {
			$this->poruka = 'Uspesno sacuvan ucenik';
		} else {
			$this->poruka = 'Neuspesno sacuvan ucenik';
		}
	}

	public function getPoruka()
	{
		return $this->poruka;
	}
}
