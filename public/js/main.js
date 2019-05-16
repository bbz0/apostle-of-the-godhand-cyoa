$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
});

var UICtrl = (function() {
	var cardsDOM, ap;

	cardsDOM = document.querySelectorAll('.choice-card');
	ap = 6;

	var cardEvents = function() {

		cardsDOM.forEach(function(card) {
			var choice = card.children[1].children[1];

			card.addEventListener('mouseover', function() {
				if(!choice.hasAttribute('disabled')) {
					card.classList.add('bg-warning');
				}
			});

			card.addEventListener('mouseout', function() {
				card.classList.remove('bg-warning');
			});

			card.addEventListener('click', function() {
				if(!choice.hasAttribute('disabled')) {
					if(choice.checked === false) {
						select(card, choice);
					} else {
						deselect(card, choice);
					}
				}
			});

		});
	};

	var select = function(card, choice) {
		card.classList.add('bg-danger', 'text-white');
		choice.checked = true;
		uncheckRest();
		if(choice.classList.contains('ability-choice')) {
			if(choice.classList.contains('abyssal')) {
				ap -= 2;
			} else {
				ap -= 1;
			}

			if(ap === 1) {
				disableAbyssal();
			} else if(ap <= 0) {
				disableAbilities();
			}
		}
	};

	var deselect = function(card, choice) {
		card.classList.remove('bg-danger', 'text-white');
		choice.checked = false;
		if(choice.classList.contains('ability-choice')) {
			if(choice.classList.contains('abyssal')) {
				ap += 2;
			} else {
				ap += 1;
			}
			if(ap > 0) {
				enableAbilities();
			}
		}
	}

	var uncheckRest = function() {

		cardsDOM.forEach(function(card) {
			var choice = card.children[1].children[1];

			if(choice.checked !== true) {
				card.classList.remove('bg-danger', 'text-white');
			}
		});
	};

	var enableAbilities = function() {

		cardsDOM.forEach(function(card) {

			var choice = card.children[1].children[1];
			
			if(choice.classList.contains('ability-choice')) {
				choice.removeAttribute('disabled', '');
				card.classList.remove('text-muted');
			}

		});
	};

	var disableAbilities = function() {

		cardsDOM.forEach(function(card) {

			var choice = card.children[1].children[1];
			
			if(choice.classList.contains('ability-choice') && choice.checked === false) {
				choice.setAttribute('disabled', '');
				card.classList.add('text-muted');
			}

		});
	};

	var disableAbyssal = function() {

		cardsDOM.forEach(function(card) {

			var choice = card.children[1].children[1];

			if(choice.classList.contains('ability-choice') && choice.classList.contains('abyssal') && choice.checked === false) {
				choice.setAttribute('disabled', '');
				card.classList.add('text-muted');
			} 

		});

	}

	return {
		init: function() {
			cardEvents();
		}
	}

})();

UICtrl.init();