

// Timeout id
let timeoutId;

// reservations policy validation
const reservationPolicyInput = $('.policyInput');

//disallowed values for input values
const disallowedValues = [
    'e',
    '+',
    '-',
    '.'
];

// keyboard inputs
reservationPolicyInput.on('keypress', function(e) {
    //disable form submit on enter key press
    if(e.keyCode === 13) {
        e.preventDefault();
    }
    //disable symbols e, + and - to be entered into input field
    if(disallowedValues.includes(e.key)) {
        e.preventDefault();
    }
});
