import './bootstrap'; 

import "../sass/app.scss";

import * as bootstrap from 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})