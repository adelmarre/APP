

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
		invalidityMessage: 'This input needs to be at least 3 characters',
		element: document.querySelector('label[for="nom"] .requiert li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
			var illegalCharacters = input.value.match(/[^a-zA-Z0-9]/g);
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
		invalidityMessage: 'This input needs to be at least 3 characters',
		element: document.querySelector('label[for="prenom"] .requiert li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
			var illegalCharacters = input.value.match(/[^a-zA-Z0-9]/g);
			return illegalCharacters ? true : false;
		},
		invalidityMessage: 'Only letters and numbers are allowed',
		element: document.querySelector('label[for="prenom"] .requiert li:nth-child(2)')
	}
];

var motdepasseValidityChecks = [
	{
		isInvalid: function(input) {
			return input.value.length < 10 | input.value.length > 100;
		},
		invalidityMessage: 'This input needs to be between 10 and 100 characters',
		element: document.querySelector('label[for="motdepasse"] .requiert li:nth-child(1)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[0-9]/g);
		},
		invalidityMessage: 'At least 1 number is required',
		element: document.querySelector('label[for="motdepasse"] .requiert li:nth-child(2)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[a-z]/g);
		},
		invalidityMessage: 'At least 1 lowercase letter is required',
		element: document.querySelector('label[for="motdepasse"] .requiert li:nth-child(3)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[A-Z]/g);
		},
		invalidityMessage: 'At least 1 uppercase letter is required',
		element: document.querySelector('label[for="motdepasse"] .requiert li:nth-child(4)')
	},
	{
		isInvalid: function(input) {
			return !input.value.match(/[\!\@\#\$\%\^\&\*]/g);
		},
		invalidityMessage: 'You need one of the required special characters',
		element: document.querySelector('label[for="motdepasse"] .requiert li:nth-child(5)')
	}
];

var mdp2ValidityChecks = [
	{
		isInvalid: function() {
			return passwordRepeatInput.value != passwordInput.value;
		},
		invalidityMessage: 'This password needs to match the first one'
	}
];




var nomInput = document.getElementById('nom');
var prénomInput = document.getElementById('prenom');

var motdepasseInput = document.getElementById('motdepasse');
var mdp2Input = document.getElementById('mdp2');

nomInput.CustomValidation = new CustomValidation(nomInput);
nomInput.CustomValidation.validityChecks = nomValidityChecks;

prénomInput.CustomValidation = new CustomValidation(prénomInput);
prénomInput.CustomValidation.validityChecks = prénomValidityChecks;

motdepasseInput.CustomValidation = new CustomValidation(motdepasseInput);
motdepasseInput.CustomValidation.validityChecks = motdepasseValidityChecks;

mdp2Input.CustomValidation = new CustomValidation(mdp2Input);
mdp2Input.CustomValidation.validityChecks = mdp2ValidityChecks;






var inputs = document.querySelectorAll('input:not([type="submit"])');


var submit = document.querySelector('input[type="submit"');
var form = document.getElementById('registration');

function validate() {
	for (var i = 0; i < inputs.length; i++) {
		inputs[i].CustomValidation.checkInput();
	}
}

submit.addEventListener('click', validate);
form.addEventListener('submit', validate);
