function orderFormValidation() {
    // Get values
    const name = document.getElementsByName("name")[0].value.trim();
    const phone = document.getElementsByName("phone")[0].value.trim();
    const pincode = document.getElementsByName("zip")[0].value.trim();
    const state = document.getElementsByName("state")[0].value.trim();
    const city = document.getElementsByName("city")[0].value.trim();
    const house_no = document.getElementsByName("address")[0].value.trim();
    const area = document.getElementsByName("locality")[0].value.trim();
    const landmark = document.getElementsByName("landmark")[0].value.trim();

    // Regex
    const nameRegex = /^[a-zA-Z\s]{2,30}$/;
    const phoneRegex = /^[6-9]\d{9}$/;
    const pincodeRegex = /^\d{6}$/;
    const textOnly = /^[a-zA-Z\s]{2,}$/;
    const houseNoRegex = /^[a-zA-Z0-9\s#/-]{1,30}$/;

    // Clear all previous errors
    const errorFields = ["name", "phone", "pincode", "state", "city", "address", "locality", "landmark"];
    errorFields.forEach(field => {
        document.getElementById(field + "Error").innerText = "";
    });

    // Validation flag
    let isValid = true;

    // Name
    if (name === "") {
        document.getElementById("nameError").innerText = "Name is required.";
        isValid = false;
    } else if (!nameRegex.test(name)) {
        document.getElementById("nameError").innerText = "Name should be 2-30 letters only.";
        isValid = false;
    }

    // Phone
    if (phone === "") {
        document.getElementById("phoneError").innerText = "Phone number is required.";
        isValid = false;
    } else if (!phoneRegex.test(phone)) {
        document.getElementById("phoneError").innerText = "Phone must start with 6-9 and be 10 digits.";
        isValid = false;
    }

    // Pincode
    if (pincode === "") {
        document.getElementById("pincodeError").innerText = "Pincode is required.";
        isValid = false;
    } else if (!pincodeRegex.test(pincode)) {
        document.getElementById("pincodeError").innerText = "Pincode must be 6 digits.";
        isValid = false;
    }

    // State
    if (state === "") {
        document.getElementById("stateError").innerText = "State is required.";
        isValid = false;
    } else if (!textOnly.test(state)) {
        document.getElementById("stateError").innerText = "State should only contain letters.";
        isValid = false;
    }

    // City
    if (city === "") {
        document.getElementById("cityError").innerText = "City is required.";
        isValid = false;
    } else if (!textOnly.test(city)) {
        document.getElementById("cityError").innerText = "City should only contain letters.";
        isValid = false;
    }

    // House No
    if (house_no === "") {
        document.getElementById("addressError").innerText = "House number is required.";
        isValid = false;
    } else if (!houseNoRegex.test(house_no)) {
        document.getElementById("addressError").innerText = "Invalid house number.";
        isValid = false;
    }

    // Area
    if (area === "") {
        document.getElementById("localityError").innerText = "Area is required.";
        isValid = false;
    } else if (!textOnly.test(area)) {
        document.getElementById("localityError").innerText = "Area should only contain letters.";
        isValid = false;
    }

    // Landmark
    if (landmark === "") {
        document.getElementById("landmarkError").innerText = "Landmark is required.";
        isValid = false;
    } else if (!textOnly.test(landmark)) {
        document.getElementById("landmarkError").innerText = "Landmark should only contain letters.";
        isValid = false;
    }

    return isValid;
}
