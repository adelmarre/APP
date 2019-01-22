

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




var motdepasseInput = document.getElementById('motdepasse');
var motdepasse2Input = document.getElementById('motdepasse2');




motdepasseInput.CustomValidation = new CustomValidation(motdepasseInput);
motdepasseInput.CustomValidation.validityChecks = motdepasseValidityChecks;

motdepasse2Input.CustomValidation = new CustomValidation(motdepasse2Input);
motdepasse2Input.CustomValidation.validityChecks = motdepasse2ValidityChecks;




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