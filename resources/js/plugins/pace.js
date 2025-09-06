import Pace from 'pace-js';
import 'pace-js/themes/blue/pace-theme-flat-top.css';

window.Pace.options = {
    ...Pace.options,
    ajax: true,
    document: true,
    eventLag: true,
    restartOnRequestAfter: false,
};

export default Pace;