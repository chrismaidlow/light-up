console.log('Welcome from index.js');
import $ from 'jquery';
import {Cells} from './Cells';
console.log('c :) from index.js');
$(document).ready(function() {
    new Cells("#cells");
});