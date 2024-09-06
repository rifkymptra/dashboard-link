import './bootstrap';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import { Chart, registerables } from 'chart.js';

window.Alpine = Alpine;
window.Swal = Swal;
window.Chart = Chart;


Alpine.start();
Chart.register(...registerables);
