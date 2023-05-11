import {
  Offcanvas,
  Dropdown,
  Input,
  Select,
  Datepicker,
  Timepicker,
  Tooltip,
  Alert,
  Ripple,
  Chart,
  Collapse,
  initTE,
} from 'tw-elements';

const tooltipTriggerList = [].slice.call(
  document.querySelectorAll('[data-te-toggle="tooltip"]')
);

tooltipTriggerList.map(
  (tooltipTriggerEl) =>
    new Tooltip(tooltipTriggerEl, {
      boundary: 'window',
      template:
        '<div class="z-30" role="tooltip"><div class="tooltip-inner inline-block bg-zinc-600 text-white font-medium rounded caption min-h-[14px] px-2 py-1"></div></div>',
      placement: 'bottom',
    })
);

initTE({
  Offcanvas,
  Dropdown,
  Input,
  Select,
  Datepicker,
  Timepicker,
  Alert,
  Ripple,
  Chart,
  Collapse,
});
