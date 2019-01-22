

function CustomValidation(input) {
	this.invalidities = [];
	this.validityChecks = [];

	this.inputNode = input;

	this.registerListener();
}

CustomValidation.prototype = {
	addInvalidity: function(message) {
		this.invalidities.push(message);
	},
	getInvalidities: function() {
		return this.invalidities.join('. \n');
	},
	checkValidity: function(input) {
		for ( var i = 0; i < this.validityChecks.length; i++ ) {

			var isInvalid = this.validityChecks[i].isInvalid(input);
			if (isInvalid) {
				this.addInvalidity(this.validityChecks[i].invalidityMessage);
			}

			var requirementElement = this.validityChecks[i].element;

			if (requirementElement) {
				if (isInvalid) {
					requirementElement.classList.add('invalid');
					requirementElement.classList.remove('valid');
				} else {
					requirementElement.classList.remove('invalid');
					requirementElement.classList.add('valid');
				}

			} 
		} 
	},
	checkInput: function() { 

		this.inputNode.CustomValidation.invalidities = [];
		this.checkValidity(this.inputNode);

		if ( this.inputNode.CustomValidation.invalidities.length === 0 && this.inputNode.value !== '' ) {
			this.inputNode.setCustomValidity('');
		} else {
			var message = this.inputNode.CustomValidation.getInvalidities();
			this.inputNode.setCustomValidity(message);
		}
	},
	registerListener: function() { 

		var CustomValidation = this;

		this.inputNode.addEventListener('keyup', function() {
			CustomValidation.checkInput();
		});


	}

};




var nomValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 3;
		},
		invalidityMessage: 'Cette entrée doit faire au moins 3 charactères',
		element: document.querySelector('label[for="nom"] .requiert li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
			var illegalCharacters = input.value.match(/[^a-zA-Z0-9\-\â\ê\ô\û\Ä\é\Æ\Ç\à\è\Ê\ù\Ì\Í\Î\Ï\Ð\î\Ò\Ó\Ô\Õ\Ö\×\Ø\Ù\Ú\Û\Ü\Ý\Þ\ß\à\á\â\ã\ä\å\æ\ç\è\é\ê\ë\ì\í\î\ï\ð\ñ\ò\ó\ô\õ\ö\ø\ù\ú\û\ü\ý\þ\ÿ\\*]/g);
			return illegalCharacters ? true : false;
		},
		invalidityMessage: 'Only letters and numbers are allowed',
		element: document.querySelector('label[for="nom"] .requiert li:nth-child(2)')
	}
];
var prénomValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 3;
		},
		invalidityMessage: 'Cette entrée doit faire au moins 3 charactères',
		element: document.querySelector('label[for="prenom"] .requiert li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
			var illegalCharacters = input.value.match(/[^a-zA-Z0-9\-\â\ê\ô\û\Ä\é\Æ\Ç\à\è\Ê\ù\Ì\Í\Î\Ï\Ð\î\Ò\Ó\Ô\Õ\Ö\×\Ø\Ù\Ú\Û\Ü\Ý\Þ\ß\à\á\â\ã\ä\å\æ\ç\è\é\ê\ë\ì\í\î\ï\ð\ñ\ò\ó\ô\õ\ö\ø\ù\ú\û\ü\ý\þ\ÿ\\*]/g);
			return illegalCharacters ? true : false;
		},
		invalidityMessage: 'Seul les lettres et les nombres sont autorisés.',
		element: document.querySelector('label[for="prenom"] .requiert li:nth-child(2)')
	}
];

var motdepasseValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 10 | input.value.length > 100;
		},
		invalidityMessage: 'CVotre mot de passe doit faire entre 10 et 100 charactères',
		element: document.querySelector('label[for="motdepasse"] .requiert li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[0-9]/g);
		},
		invalidityMessage: 'Votre mot de passe doit avoir au moins un chiffre',
		element: document.querySelector('label[for="motdepasse"] .requiert li:nth-child(2)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[a-z]/g);
		},
		invalidityMessage: 'Votre mot de passe doit avoir au moins une minuscule',
		element: document.querySelector('label[for="motdepasse"] .requiert li:nth-child(3)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[A-Z]/g);
		},
		invalidityMessage: 'Votre mot de passe doit avoir au moins une majuscule',
		element: document.querySelector('label[for="motdepasse"] .requiert li:nth-child(4)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[\!\@\#\$\%\^\&\*]/g);
		},
		invalidityMessage: 'Votre mot de passe doit avoir au moins un charactère spécial ( !, *, ?,...)',
		element: document.querySelector('label[for="motdepasse"] .requiert li:nth-child(5)')
	}
];

var motdepasse2ValidityChecks = [
	{
		isInvalid: function(input) {
			return motdepasse2Input.value != motdepasseInput.value;
		},
		invalidityMessage: 'Ce mot de passe doit être le même.'
	}

]; 

var mailValidityChecks = [
{
	isInvalid: function(input) {
			return !input.value.match(/[\@]/g);
			//return !input.value.match(/[^a-zA-Z0-9]/g);
		},
		invalidityMessage: 'Votre mail doit avoir la forme conventionnelle (contenir un @)',
		//element: document.querySelector('label[for="mail"] .requiert li:nth-child(1)')
	},
	
];


var numeroValidityChecks = [{
	
	isInvalid: function(input) {
			return !input.value.match(/[0-9]/g);
		},
		invalidityMessage: 'Cette entrée ne peut contenir que des chiffres.',
		element: document.querySelector('label[for="numero"] .requiert li:nth-child(1)')
}
];

var nomInput = document.getElementById('nom');
var prénomInput = document.getElementById('prenom');
var motdepasseInput = document.getElementById('motdepasse');
var motdepasse2Input = document.getElementById('motdepasse2');
var mailInput = document.getElementById('mail');
var cpInput = document.getElementById('cp');
var numeroInput = document.getElementById('numero');

nomInput.CustomValidation = new CustomValidation(nomInput);
nomInput.CustomValidation.validityChecks = nomValidityChecks;

prénomInput.CustomValidation = new CustomValidation(prénomInput);
prénomInput.CustomValidation.validityChecks = prénomValidityChecks;

motdepasseInput.CustomValidation = new CustomValidation(motdepasseInput);
motdepasseInput.CustomValidation.validityChecks = motdepasseValidityChecks;

motdepasse2Input.CustomValidation = new CustomValidation(motdepasse2Input);
motdepasse2Input.CustomValidation.validityChecks = motdepasse2ValidityChecks;

mailInput.CustomValidation = new CustomValidation(mailInput);
mailInput.CustomValidation.validityChecks = mailValidityChecks;

numeroInput.CustomValidation = new CustomValidation(numeroInput);
numeroInput.CustomValidation.validityChecks = numeroValidityChecks;


var inputs = document.querySelectorAll('input:not([type="submit"])');
var submit = document.querySelector('input[type="submit"]');
var form = document.getElementById('registration');

function validate() {
	for (var i = 0; i < inputs.length; i++) {
		inputs[i].CustomValidation.checkInput();
	}
}

submit.addEventListener('click', validate);
form.addEventListener('submit', validate);