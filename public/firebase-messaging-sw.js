importScripts("https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.18.0/firebase-messaging.js");

var firebaseConfig = {
    apiKey: "AIzaSyBwlvQSl6Cig7QIkJ-iCD9EzBL10pGPcSA",
    authDomain: "realtimenotifications-970c6.firebaseapp.com",
    databaseURL: "https://realtimenotifications-970c6.firebaseio.com",
    projectId: "realtimenotifications-970c6",
    storageBucket: "realtimenotifications-970c6.appspot.com",
    messagingSenderId: "776973028210",
    appId: "1:776973028210:web:3ffc2376772d4dc8026beb",
    measurementId: "G-N2ZCGT7MPW",
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Retrieve Firebase Messaging object.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload
    );
    // Customize notification here
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/firebase-logo.png"
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions
    );
});
