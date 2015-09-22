<?php

class Birthday extends CWidget {

    public function run() {
        $birthdays = User::model()->getBirthdays();
        $this->render('birthday', array('birthdays'=>$birthdays));
    }
}