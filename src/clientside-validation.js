// ************************************** NEW PROPERTY ********************************* 

$('#newPropertyForm').validate({

    rules:{
        title:{
            required: true,
            minlength: 5,
            maxlength: 25
        },
        description:{
            required: true,
            minlength: 15,
            maxlength: 350
        },
        zipcode:{
            required: true,
            number: true,
            minlength: 4,
            maxlength: 4
        },
        city:{
            required: true,
            minlength: 2,
            maxlength: 25
        },
        address:{
            required: true,
            minlength: 2,
            maxlength: 30
        },
        price:{
            required: true,
            min: 1000,
            max: 50000000
        },
        beds:{
            required: true,
            min: 1,
            max: 10
        },
        baths:{
            required: true,
            min: 1,
            max: 10
        },
        meters:{
            required: true,
            min: 10,
            max: 1000
        },
        latitude:{
            required: true,
            minlength: 9,
            maxlength: 9
        },
        longitude:{
            required: true,
            minlength: 9,
            maxlength: 9
        },
        image:{
            required: true,
            accept: "image/jpg,image/jpeg,image/png,image/gif"
        }
    },
    messages:{
        title:{
            required: "You have to enter a title for the property",
            minlength: "The title cannot be less than five characters",
            maxlength: "The title cannot be more than 25 characters"
        },
        description:{
            required: "You have to enter a description for the property",
            minlength: "The description cannot be less than 15 characters",
            maxlength: "The description cannot be more than 350 characters"
        },
        zipcode:{
            required: "You have to enter a zipcode for the property",
            number: "The zipcode must be digits",
            minlength: "The zipcode must be four digits",
            maxlength: "The zipcode must be four digits"
        },
        city:{
            required: "You have to enter a city for the property",
            minlength: "The city must be at least two characters",
            maxlength: "The city cannot be more than 25 characters",
        },
        address:{
            required: "You have to enter an address for the property",
            minlength: "The address must be at least two characters",
            maxlength: "The address cannot be more than 30 characters"
        },
        price:{
            required: "You have to enter a price for the property",
            min: "The price must be at least 1000",
            max: "The price cannot be more than 50000000"
        },
        beds:{
            required: "You have to enter the amount of bedrooms for the property",
            min: "The minimum amount of bedrooms is 1",
            max: "The maximum amount of bedrooms is 10"
        },
        baths:{
            required: "You have to enter the amount of bathrooms for the property",
            min: "The minimum amount of bathrooms is 1",
            max: "The maximum amount of bathrooms is 10"
        },
        meters:{
            required: "You have to enter the amount of square meters for the property",
            min: "The minimum amount of square meters is 10",
            max: "The maximum amount of square meters is 1000"
        },
        latitude:{
            required: "You have to enter a valid latitude value - similar to '12.234567'",
            minlength: "You have to enter a valid latitude value - similar to '12.234567'",
            maxlength: "You have to enter a valid latitude value - similar to '12.234567'"
        },
        longitude:{
            required: "You have to enter a valid longitude value - similar to '55.234567'",
            minlength: "You have to enter a valid longitude value - similar to '55.234567'",
            maxlength: "You have to enter a valid longitude value - similar to '55.234567'"
        },
        image:{
            required: "You have to submit an image of the property",
            accept: "Please only submit a valid image - only .png, .jpg, .jpeg and .gif"
        }
    }
});

// ************************************** SIGN IN FORM  ********************************* 

$('#signInForm').validate({

    rules:{
        email:{
            required: true,
        },
        password:{
            required: true,
        }
    },
    messages:{
        email:{
            required: "You must enter an email",
        },
        password:{
            required: "You must enter a password",
        }
    }
    });

// ************************************** NEW USER SIGNUP FORM  ********************************* 

$('#newUserForm').validate({

    rules:{
        userName:{
            required: true,
            minlength: 2,
            maxlength: 25
        },
        userLastName:{
            required: true,
            minlength: 2,
            maxlength: 25
        },
        userEmail:{
            required: true,
            email: true
        },
        userPassword:{
            required: true,
            minlength: 6,
            maxlength: 35
        },
        userImage:{
            accept: "image/jpg,image/jpeg,image/png,image/gif"
        }
    },
    messages:{
        userName:{
            required: "Please enter your first name",
            minlength: "Please enter at least two characters",
            maxlength: "Please enter no more than 25 characters"
        },
        userLastName:{
            required: "Please enter your last name",
            minlength: "Please enter at least two characters",
            maxlength: "Please enter no more than 25 characters"
        },
        userEmail:{
            required: "Please enter your email",
            email: "Please enter a valid email"
        },
        userPassword:{
            required: "Please enter a password",
            minlength: "Your password must be at least 6 characters",
            maxlength: "Your password cannot be more than 35 characters"
        },
        userImage:{
            accept: "Please only submit a valid image - only .png, .jpg, .jpeg and .gif"
        }
    }
});

// ************************************** NEW AGENT SIGNUP FORM  ********************************* 

$('#newAgentForm').validate({

    rules:{
        agentName:{
            required: true,
            minlength: 2,
            maxlength: 25
        },
        agentLastName:{
            required: true,
            minlength: 2,
            maxlength: 25
        },
        agentEmail:{
            required: true,
            email: true
        },
        agentPassword:{
            required: true,
            minlength: 6,
            maxlength: 35
        },
        agentAddress:{
            required: true,
        },
        agentCity:{
            required: true,
        },
        agentCountry:{
            required: true,
        },
        agentImage:{
            required: true,
            accept: "image/jpg,image/jpeg,image/png,image/gif"
        }
    },
    messages:{
        agentName:{
            required: "Please enter your first name",
            minlength: "Please enter at least two characters",
            maxlength: "Please enter no more than 25 characters"
        },
        agentLastName:{
            required: "Please enter your last name",
            minlength: "Please enter at least two characters",
            maxlength: "Please enter no more than 25 characters"
        },
        agentEmail:{
            required: "Please enter your email",
            email: "Please enter a valid email"
        },
        agentPassword:{
            required: "Please enter a password",
            minlength: "Your password must be at least 6 characters",
            maxlength: "Your password cannot be more than 35 characters"
        },
        agentAddress:{
            required: "Please enter your address"
        },
        agentCity:{
            required: "Please enter your city"
        },
        agentCountry:{
            required: "Please enter your country"
        },
        agentImage:{
            required: "As an agent you must submit a profile picture",
            accept: "Please only submit a valid image - only .png, .jpg, .jpeg and .gif"
        }
    }

});

// ************************************** PROFILE EDIT FORM  ********************************* 

$('#profileEditForm').validate({

    rules:{
        firstname:{
            required: true,
            minlength: 2,
            maxlength: 25
        },
        lastname:{
            required: true,
            minlength: 2,
            maxlength: 25
        },
        address:{
            required: true,
            minlength: 3,
            maxlength: 20
        },
        city:{
            required: true,
            minlength: 3,
            maxlength: 20
        },
        country:{
            required: true,
            minlength: 3,
            maxlength: 20
        },
        image:{
            accept: "image/jpg,image/jpeg,image/png,image/gif"
        }
    },
    messages:{
        firstname:{
            required: "Please enter your first name",
            minlength: "First name must be more than two characters",
            maxlength: "First name cannot be more than 25 characters"
        },
        lastname:{
            required: "Please enter your last name",
            minlength: "Last name must be more than two characters",
            maxlength: "Last name cannot be more than 25 characters"
        },
        address:{
            minlength: "Address must be at least three characters",
            maxlength: "Address cannot be more than 20 characters"
        },
        city:{
            minlength: "City must be at least three characters",
            maxlength: "City cannot be more than 20 characters"
        },
        country:{
            minlength: "Country must be at least three characters",
            maxlength: "Country cannot be more than 20 characters"
        },
        image:{
            accept: "Please only submit a valid image - only .png, .jpg, .jpeg and .gif"
        }
    }

});

// ************************************** UPDATE PROPERTY FORM  ********************************* 

$('#updatePropertyId').validate({

    rules:{
        title:{
            required: true,
            minlength: 5,
            maxlength: 25
        },
        description:{
            required: true,
            minlength: 15,
            maxlength: 350
        },
        zipcode:{
            required: true,
            number: true,
            minlength: 4,
            maxlength: 4
        },
        city:{
            required: true,
            minlength: 2,
            maxlength: 25
        },
        address:{
            required: true,
            minlength: 2,
            maxlength: 30
        },
        price:{
            required: true,
            min: 1000,
            max: 50000000
        },
        bedrooms:{
            required: true,
            min: 1,
            max: 10
        },
        bathrooms:{
            required: true,
            min: 1,
            max: 10
        },
        meters:{
            required: true,
            min: 10,
            max: 1000
        },
        image:{
            accept: "image/jpg,image/jpeg,image/png,image/gif"
        }
    },
    messages:{
        title:{
            required: "You have to enter a title for the property",
            minlength: "The title cannot be less than five characters",
            maxlength: "The title cannot be more than 25 characters"
        },
        description:{
            required: "You have to enter a description for the property",
            minlength: "The description cannot be less than 15 characters",
            maxlength: "The description cannot be more than 350 characters"
        },
        zipcode:{
            required: "You have to enter a zipcode for the property",
            number: "The zipcode must be digits",
            minlength: "The zipcode must be four digits",
            maxlength: "The zipcode must be four digits"
        },
        city:{
            required: "You have to enter a city for the property",
            minlength: "The city must be at least two characters",
            maxlength: "The city cannot be more than 25 characters",
        },
        address:{
            required: "You have to enter an address for the property",
            minlength: "The address must be at least two characters",
            maxlength: "The address cannot be more than 30 characters"
        },
        price:{
            required: "You have to enter a price for the property",
            min: "The price must be at least 1000",
            max: "The price cannot be more than 50000000"
        },
        bedrooms:{
            required: "You have to enter the amount of bedrooms for the property",
            min: "The minimum amount of bedrooms is 1",
            max: "The maximum amount of bedrooms is 10"
        },
        bathrooms:{
            required: "You have to enter the amount of bathrooms for the property",
            min: "The minimum amount of bathrooms is 1",
            max: "The maximum amount of bathrooms is 10"
        },
        meters:{
            required: "You have to enter the amount of square meters for the property",
            min: "The minimum amount of square meters is 10",
            max: "The maximum amount of square meters is 1000"
        },
        image:{
            accept: "Please only submit a valid image - only .png, .jpg, .jpeg and .gif"
        }
    }

});
