/******** CUSTOM *********/
import naja from 'naja';
import "./custom/naja/initNaja";
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import "quill/quill";
import "./custom/styles/scripts";
import "simple-datatables";
import "./custom/styles/scripts";

/********* REACT COMPONENTS *********/
import {getOrbatData} from "./react-app/App";

/********* FEATURES *********/
//import {getServerStatus} from './custom/ServerManagement/serverManagement';

//OPRAVIT - websocket? nech request nezahlcuje server
function ServerManagementInit() {
}

/********* FUNCTIONS *********/
naja.addEventListener('init', getOrbatData);
naja.addEventListener('complete', getOrbatData);
naja.addEventListener('init', ServerManagementInit);// F5
naja.addEventListener('complete', ServerManagementInit);// snippet
