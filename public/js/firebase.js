var firebaseConfig = {
    apiKey: "AIzaSyBwlvQSl6Cig7QIkJ-iCD9EzBL10pGPcSA",
    authDomain: "realtimenotifications-970c6.firebaseapp.com",
    databaseURL: "https://realtimenotifications-970c6.firebaseio.com",
    projectId: "realtimenotifications-970c6",
    storageBucket: "realtimenotifications-970c6.appspot.com",
    messagingSenderId: "776973028210",
    appId: "1:776973028210:web:3ffc2376772d4dc8026beb",
    measurementId: "G-N2ZCGT7MPW"
};

  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

    // Retrieve Firebase Messaging object.
    const messaging = firebase.messaging();
        messaging.requestPermission()
        .then( ()=>{
            console.log("Notification permission granted");
            return messaging.getToken();
        
        }).then( (token)=>{
            $('#device_token').val(token);
            console.log(token);
        }).catch( (err)=>{
            console.log("Unable to get permission to notify.",err);
        });

        //------------------------------------------------

messaging.onMessage( (payload)=>{
    console.log(payload);
});