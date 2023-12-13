// Function to send an SMS via Twilio
function sendSMS() {
    // Data to be sent to the server
    const data = {
        to: '+9567191205', // Replace with the recipient's phone number
        message: 'Your login to XYZ service has been confirmed.' // Your message content
    };

    // Make an HTTP POST request to your server-side endpoint
    fetch('/send-sms', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            console.log('SMS sent successfully');
        } else {
            console.error('Failed to send SMS');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Call the function to send the SMS when needed
sendSMS();
