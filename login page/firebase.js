    // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyCKzDrPHCWl_G0PoCSXLrLTUNA71O-4zRE",
    authDomain: "novango.firebaseapp.com",
    projectId: "novango",
    storageBucket: "novango.firebasestorage.app",
    messagingSenderId: "800884738457",
    appId: "1:800884738457:web:912ec6bf1f636b99caeb08",
    measurementId: "G-0V018LP86V"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
