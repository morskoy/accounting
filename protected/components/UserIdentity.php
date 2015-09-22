<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{


	// Будем хранить id.
   protected $_id;

	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and passwordword
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		
		// Производим стандартную аутентификацию, описанную в руководстве.
        $user = User::model()->find('LOWER(login)=?', array(strtolower($this->username)));
        if(($user===null) or (md5($this->password)!==$user->password)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            // В качестве идентификатора будем использовать id, а не username,
            // как это определено по умолчанию. Обязательно нужно переопределить
            // метод getId(см. ниже).
            $this->_id = $user->id;
 
            // Далее логин нам не понадобится, зато имя может пригодится
            // в самом приложении. Используется как Yii::app()->user->name.
            // realName есть в нашей модели. У вас это может быть name, firstName
            // или что-либо ещё.
            $this->username = $user->last_name." ".$user->name;

            $this->setState('name', $user->name." ".$user->middle_name);
            //$this->setState('editTable', $user->edit_table);

            $this->setState('shortName', $user->last_name.' '.mb_substr($user->name,0,1,Yii::app()->charset).'.'.mb_substr($user->middle_name,0,1,Yii::app()->charset).'.');
            $this->setState('post', $user->post->department);
            $this->setState('id_post', $user->id_post);
 
            $this->errorCode = self::ERROR_NONE;
        }
       return !$this->errorCode;		
		
	}
		
	public function getId(){
        return $this->_id;
   }


}