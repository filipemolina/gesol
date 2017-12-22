importScript("https://www.gstatic.com/firebasejs/4.8.0/firebase-app.js");
importScript("https://www.gstatic.com/firebasejs/4.8.0/firebase-messaging.js");

// Initialize Firebase
var config = {
  apiKey: "AIzaSyAf8fw2qFhvj8IBucvbtYiA_9Odrwqb_-8",
  authDomain: "mesquita-360.firebaseapp.com",
  databaseURL: "https://mesquita-360.firebaseio.com",
  projectId: "mesquita-360",
  storageBucket: "mesquita-360.appspot.com",
  messagingSenderId: "22259915167"
};
firebase.initializeApp(config);

const messaging  = firebase.messaging();
