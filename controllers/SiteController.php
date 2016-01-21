<?php

Class SiteController
{
	public function actionIndex()
	{
		echo "Main page";
		return true;
	}

	public function actionAbout()
	{
		echo "About";
		return true;
	}

	public function actionContacts()
	{
		echo "Contacts";
		return true;
	}
}