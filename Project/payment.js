function showAdditionalFields() {
    const transactionMethod = document.getElementById("transactionMethod").value;
    const additionalFieldsDiv = document.getElementById("additionalFields");

    additionalFieldsDiv.innerHTML = "";

    if (transactionMethod === "online") {
        // Create an input field for the transaction ID
        const transactionIdLabel = document.createElement("label");
        transactionIdLabel.textContent = "Transaction ID:";
        const transactionIdInput = document.createElement("input");
        transactionIdInput.type = "text";
        transactionIdInput.id = "transactionId";
        transactionIdInput.name = "transactionId";
        transactionIdInput.required = true;
        additionalFieldsDiv.appendChild(transactionIdLabel);
        additionalFieldsDiv.appendChild(transactionIdInput);

        // Create an input field for the payment medium
        const paymentMediumLabel = document.createElement("label");
        paymentMediumLabel.textContent = "Payment Medium:(Bikash,nagad etc.)";
        const paymentMediumInput = document.createElement("input");
        paymentMediumInput.type = "text"; // You can adjust the input type as needed
        paymentMediumInput.id = "paymentMedium";
        paymentMediumInput.name = "paymentMedium";
        paymentMediumInput.required = true;
        additionalFieldsDiv.appendChild(paymentMediumLabel);
        additionalFieldsDiv.appendChild(paymentMediumInput);
    } else if (transactionMethod === "offline") {
        // Create an input field for the volunteer name
        const volunteerNameLabel = document.createElement("label");
        volunteerNameLabel.textContent = "Volunteer Name:";
        const volunteerNameInput = document.createElement("input");
        volunteerNameInput.type = "text";
        volunteerNameInput.id = "volunteerName";
        volunteerNameInput.name = "volunteerName";
        volunteerNameInput.required = true;
        additionalFieldsDiv.appendChild(volunteerNameLabel);
        additionalFieldsDiv.appendChild(volunteerNameInput);
    }
}
