<?php
class ApiStatusCode {
	#system
	static public $ok = 10000;
	static public $error = 10004;
	static public $paramsAbsent = 10005;
	static public $signError = 10006;
	static public $errors = 10007;
	static public $noFind = 10008;
	static public $failure = 10009;
        static public $isEmpty = 10010;
	#customer
	static public $passowrdOrNameError = 20002;
	static public $customerNotExisit = 20003;
	static public $customerIsExisit = 20004;
	static public $isGuest = 20005;
	static public $usernameChanged = 20006;
	static public $phoneisExisit = 20008;
	static public $SeccdoeError = 20011;
	static public $sessionExpired = 20021;
	static public $resetPasswordFailded = 20031;
	static public $registerFailed = 20032;
	static public $loginFailed = 20033;
	#Appointment
	static public $minimumPaymentError = 20101;
	static public $raiseUpper = 20102;
	static public $investmentUpperLimit = 20103;
	static public $sellOrganizationNotExisit = 20106;
	static public $appointmentFailed = 20107;
	static public $productRaised = 20108;
	static public $ProductIsNotSell = 20109;

    #org
    static public $orgIDisExisit = 100201;
}