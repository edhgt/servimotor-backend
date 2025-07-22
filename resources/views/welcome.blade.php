<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{__('Bienvenido')}} | {{ENV('APP_NAME')}}</title>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* ! tailwindcss v3.4.17 | MIT License | https://tailwindcss.com */*,:before,:after{--tw-border-spacing-x: 0;--tw-border-spacing-y: 0;--tw-translate-x: 0;--tw-translate-y: 0;--tw-rotate: 0;--tw-skew-x: 0;--tw-skew-y: 0;--tw-scale-x: 1;--tw-scale-y: 1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness: proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width: 0px;--tw-ring-offset-color: #fff;--tw-ring-color: rgb(59 130 246 / .5);--tw-ring-offset-shadow: 0 0 #0000;--tw-ring-shadow: 0 0 #0000;--tw-shadow: 0 0 #0000;--tw-shadow-colored: 0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }::backdrop{--tw-border-spacing-x: 0;--tw-border-spacing-y: 0;--tw-translate-x: 0;--tw-translate-y: 0;--tw-rotate: 0;--tw-skew-x: 0;--tw-skew-y: 0;--tw-scale-x: 1;--tw-scale-y: 1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness: proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width: 0px;--tw-ring-offset-color: #fff;--tw-ring-color: rgb(59 130 246 / .5);--tw-ring-offset-shadow: 0 0 #0000;--tw-ring-shadow: 0 0 #0000;--tw-shadow: 0 0 #0000;--tw-shadow-colored: 0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }*,:before,:after{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}:before,:after{--tw-content: ""}html,:host{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;-o-tab-size:4;tab-size:4;font-family:Figtree,ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji",Segoe UI Symbol,"Noto Color Emoji";font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,samp,pre{font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;letter-spacing:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}button,input:where([type=button]),input:where([type=reset]),input:where([type=submit]){-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dl,dd,h1,h2,h3,h4,h5,h6,hr,figure,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}ol,ul,menu{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::-moz-placeholder,textarea::-moz-placeholder{opacity:1;color:#9ca3af}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}button,[role=button]{cursor:pointer}:disabled{cursor:default}img,svg,video,canvas,audio,iframe,embed,object{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]:where(:not([hidden=until-found])){display:none}.absolute{position:absolute}.relative{position:relative}.-bottom-16{bottom:-4rem}.-left-16{left:-4rem}.-left-20{left:-5rem}.top-0{top:0}.z-0{z-index:0}.\!row-span-1{grid-row:span 1 / span 1!important}.-mx-3{margin-left:-.75rem;margin-right:-.75rem}.-ml-px{margin-left:-1px}.ml-3{margin-left:.75rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.flex{display:flex}.inline-flex{display:inline-flex}.table{display:table}.grid{display:grid}.\!hidden{display:none!important}.hidden{display:none}.aspect-video{aspect-ratio:16 / 9}.size-12{width:3rem;height:3rem}.size-5{width:1.25rem;height:1.25rem}.size-6{width:1.5rem;height:1.5rem}.h-12{height:3rem}.h-40{height:10rem}.h-5{height:1.25rem}.h-full{height:100%}.min-h-screen{min-height:100vh}.w-5{width:1.25rem}.w-\[calc\(100\%_\+_8rem\)\]{width:calc(100% + 8rem)}.w-auto{width:auto}.w-full{width:100%}.max-w-2xl{max-width:42rem}.max-w-\[877px\]{max-width:877px}.flex-1{flex:1 1 0%}.shrink-0{flex-shrink:0}.transform{transform:translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.cursor-default{cursor:default}.resize{resize:both}.grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.\!flex-row{flex-direction:row!important}.flex-col{flex-direction:column}.items-start{align-items:flex-start}.items-center{align-items:center}.items-stretch{align-items:stretch}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.justify-between{justify-content:space-between}.justify-items-center{justify-items:center}.gap-2{gap:.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.self-center{align-self:center}.overflow-hidden{overflow:hidden}.rounded-\[10px\]{border-radius:10px}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:.5rem}.rounded-md{border-radius:.375rem}.rounded-sm{border-radius:.125rem}.rounded-l-md{border-top-left-radius:.375rem;border-bottom-left-radius:.375rem}.rounded-r-md{border-top-right-radius:.375rem;border-bottom-right-radius:.375rem}.border{border-width:1px}.border-gray-300{--tw-border-opacity: 1;border-color:rgb(209 213 219 / var(--tw-border-opacity, 1))}.bg-\[\#FF2D20\]\/10{background-color:#ff2d201a}.bg-gray-50{--tw-bg-opacity: 1;background-color:rgb(249 250 251 / var(--tw-bg-opacity, 1))}.bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity, 1))}.bg-gradient-to-b{background-image:linear-gradient(to bottom,var(--tw-gradient-stops))}.from-transparent{--tw-gradient-from: transparent var(--tw-gradient-from-position);--tw-gradient-to: rgb(0 0 0 / 0) var(--tw-gradient-to-position);--tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)}.via-white{--tw-gradient-to: rgb(255 255 255 / 0) var(--tw-gradient-to-position);--tw-gradient-stops: var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)}.to-white{--tw-gradient-to: #fff var(--tw-gradient-to-position)}.to-zinc-900{--tw-gradient-to: #18181b var(--tw-gradient-to-position)}.stroke-\[\#FF2D20\]{stroke:#ff2d20}.object-cover{-o-object-fit:cover;object-fit:cover}.object-top{-o-object-position:top;object-position:top}.p-6{padding:1.5rem}.px-2{padding-left:.5rem;padding-right:.5rem}.px-3{padding-left:.75rem;padding-right:.75rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.py-16{padding-top:4rem;padding-bottom:4rem}.py-2{padding-top:.5rem;padding-bottom:.5rem}.pt-3{padding-top:.75rem}.text-center{text-align:center}.font-sans{font-family:Figtree,ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji",Segoe UI Symbol,"Noto Color Emoji"}.text-sm{font-size:.875rem;line-height:1.25rem}.text-sm\/relaxed{font-size:.875rem;line-height:1.625}.text-xl{font-size:1.25rem;line-height:1.75rem}.font-medium{font-weight:500}.font-semibold{font-weight:600}.leading-5{line-height:1.25rem}.text-black{--tw-text-opacity: 1;color:rgb(0 0 0 / var(--tw-text-opacity, 1))}.text-black\/50{color:#00000080}.text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity, 1))}.text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity, 1))}.text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.underline{text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-\[0px_14px_34px_0px_rgba\(0\,0\,0\,0\.08\)\]{--tw-shadow: 0px 14px 34px 0px rgba(0,0,0,.08);--tw-shadow-colored: 0px 14px 34px 0px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.shadow-sm{--tw-shadow: 0 1px 2px 0 rgb(0 0 0 / .05);--tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.ring-1{--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow, 0 0 #0000)}.ring-black{--tw-ring-opacity: 1;--tw-ring-color: rgb(0 0 0 / var(--tw-ring-opacity, 1))}.ring-gray-300{--tw-ring-opacity: 1;--tw-ring-color: rgb(209 213 219 / var(--tw-ring-opacity, 1))}.ring-transparent{--tw-ring-color: transparent}.ring-white{--tw-ring-opacity: 1;--tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity, 1))}.ring-white\/\[0\.05\]{--tw-ring-color: rgb(255 255 255 / .05)}.drop-shadow-\[0px_4px_34px_rgba\(0\,0\,0\,0\.06\)\]{--tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0,0,0,.06));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.drop-shadow-\[0px_4px_34px_rgba\(0\,0\,0\,0\.25\)\]{--tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0,0,0,.25));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.filter{filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.transition{transition-property:color,background-color,border-color,text-decoration-color,fill,stroke,opacity,box-shadow,transform,filter,-webkit-backdrop-filter;transition-property:color,background-color,border-color,text-decoration-color,fill,stroke,opacity,box-shadow,transform,filter,backdrop-filter;transition-property:color,background-color,border-color,text-decoration-color,fill,stroke,opacity,box-shadow,transform,filter,backdrop-filter,-webkit-backdrop-filter;transition-timing-function:cubic-bezier(.4,0,.2,1);transition-duration:.15s}.duration-150{transition-duration:.15s}.duration-300{transition-duration:.3s}.ease-in-out{transition-timing-function:cubic-bezier(.4,0,.2,1)}.selection\:bg-\[\#FF2D20\] *::-moz-selection{--tw-bg-opacity: 1;background-color:rgb(255 45 32 / var(--tw-bg-opacity, 1))}.selection\:bg-\[\#FF2D20\] *::selection{--tw-bg-opacity: 1;background-color:rgb(255 45 32 / var(--tw-bg-opacity, 1))}.selection\:text-white *::-moz-selection{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.selection\:text-white *::selection{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.selection\:bg-\[\#FF2D20\]::-moz-selection{--tw-bg-opacity: 1;background-color:rgb(255 45 32 / var(--tw-bg-opacity, 1))}.selection\:bg-\[\#FF2D20\]::selection{--tw-bg-opacity: 1;background-color:rgb(255 45 32 / var(--tw-bg-opacity, 1))}.selection\:text-white::-moz-selection{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.selection\:text-white::selection{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.hover\:text-black:hover{--tw-text-opacity: 1;color:rgb(0 0 0 / var(--tw-text-opacity, 1))}.hover\:text-black\/70:hover{color:#000000b3}.hover\:text-gray-400:hover{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity, 1))}.hover\:text-gray-500:hover{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity, 1))}.hover\:ring-black\/20:hover{--tw-ring-color: rgb(0 0 0 / .2)}.focus\:z-10:focus{z-index:10}.focus\:border-blue-300:focus{--tw-border-opacity: 1;border-color:rgb(147 197 253 / var(--tw-border-opacity, 1))}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus\:ring:focus{--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow, 0 0 #0000)}.focus-visible\:ring-1:focus-visible{--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow, 0 0 #0000)}.focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity: 1;--tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity, 1))}.active\:bg-gray-100:active{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity, 1))}.active\:text-gray-500:active{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity, 1))}.active\:text-gray-700:active{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity, 1))}@media (min-width: 640px){.sm\:flex{display:flex}.sm\:hidden{display:none}.sm\:size-16{width:4rem;height:4rem}.sm\:size-6{width:1.5rem;height:1.5rem}.sm\:flex-1{flex:1 1 0%}.sm\:items-center{align-items:center}.sm\:justify-between{justify-content:space-between}.sm\:pt-5{padding-top:1.25rem}}@media (min-width: 768px){.md\:row-span-3{grid-row:span 3 / span 3}}@media (min-width: 1024px){.lg\:col-start-2{grid-column-start:2}.lg\:h-16{height:4rem}.lg\:max-w-7xl{max-width:80rem}.lg\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.lg\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.lg\:flex-col{flex-direction:column}.lg\:items-end{align-items:flex-end}.lg\:justify-center{justify-content:center}.lg\:gap-8{gap:2rem}.lg\:p-10{padding:2.5rem}.lg\:pb-10{padding-bottom:2.5rem}.lg\:pt-0{padding-top:0}.lg\:text-\[\#FF2D20\]{--tw-text-opacity: 1;color:rgb(255 45 32 / var(--tw-text-opacity, 1))}}.rtl\:flex-row-reverse:where([dir=rtl],[dir=rtl] *){flex-direction:row-reverse}@media (prefers-color-scheme: dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:border-gray-600{--tw-border-opacity: 1;border-color:rgb(75 85 99 / var(--tw-border-opacity, 1))}.dark\:bg-black{--tw-bg-opacity: 1;background-color:rgb(0 0 0 / var(--tw-bg-opacity, 1))}.dark\:bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity, 1))}.dark\:bg-zinc-900{--tw-bg-opacity: 1;background-color:rgb(24 24 27 / var(--tw-bg-opacity, 1))}.dark\:via-zinc-900{--tw-gradient-to: rgb(24 24 27 / 0) var(--tw-gradient-to-position);--tw-gradient-stops: var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)}.dark\:to-zinc-900{--tw-gradient-to: #18181b var(--tw-gradient-to-position)}.dark\:text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity, 1))}.dark\:text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity, 1))}.dark\:text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity, 1))}.dark\:text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.dark\:text-white\/50{color:#ffffff80}.dark\:text-white\/70{color:#ffffffb3}.dark\:ring-zinc-800{--tw-ring-opacity: 1;--tw-ring-color: rgb(39 39 42 / var(--tw-ring-opacity, 1))}.dark\:hover\:text-gray-300:hover{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity, 1))}.dark\:hover\:text-white:hover{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.dark\:hover\:text-white\/70:hover{color:#ffffffb3}.dark\:hover\:text-white\/80:hover{color:#fffc}.dark\:hover\:ring-zinc-700:hover{--tw-ring-opacity: 1;--tw-ring-color: rgb(63 63 70 / var(--tw-ring-opacity, 1))}.dark\:focus\:border-blue-700:focus{--tw-border-opacity: 1;border-color:rgb(29 78 216 / var(--tw-border-opacity, 1))}.dark\:focus\:border-blue-800:focus{--tw-border-opacity: 1;border-color:rgb(30 64 175 / var(--tw-border-opacity, 1))}.dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity: 1;--tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity, 1))}.dark\:focus-visible\:ring-white:focus-visible{--tw-ring-opacity: 1;--tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity, 1))}.dark\:active\:bg-gray-700:active{--tw-bg-opacity: 1;background-color:rgb(55 65 81 / var(--tw-bg-opacity, 1))}.dark\:active\:text-gray-300:active{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity, 1))}}
            </style>
        @endif
    </head>
    <body>
         <!-- nav bar section -->
        <nav class="flex flex-wrap items-center justify-between p-3 bg-[#e8e8e5]">
            <div class="text-xl">{{ENV('APP_NAME')}}</div>
            <div class="flex md:hidden">
                <button id="hamburger">
                <img class="toggle block" src="https://img.icons8.com/fluent-systems-regular/2x/menu-squared-2.png" width="40" height="40" />
                <img class="toggle hidden" src="https://img.icons8.com/fluent-systems-regular/2x/close-window.png" width="40" height="40" />
                </button>
            </div>
            <div class=" toggle hidden w-full md:w-auto md:flex text-right text-bold mt-5 md:mt-0 md:border-none">
                <a href="#home" class="block md:inline-block hover:text-blue-500 px-3 py-3 md:border-none">{{__('Home')}}
                </a>
                <a href="#services" class="block md:inline-block hover:text-blue-500 px-3 py-3 md:border-none">Servicios
                </a>
                <a href="#aboutus" class="block md:inline-block hover:text-blue-500 px-3 py-3 md:border-none">Acerca de nosotros
                </a>
                <a href="#gallery" class="block md:inline-block hover:text-blue-500 px-3 py-3 md:border-none">Galería
                </a>
                <a href="#contactUs" class="block md:inline-block hover:text-blue-500 px-3 py-3 md:border-none">Visitanos
                </a>
            </div>

            <div class="toggle w-full text-end hidden md:flex md:w-auto px-2 py-2 md:rounded">
                <a href="tel:+123">
                    <div class="flex justify-end">
                        <div class="flex items-center h-10 w-30 rounded-md bg-[#c8a876] text-white font-medium p-2">
                            <!-- Heroicon name: phone -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            Llámanos
                        </div>
                    </div>
                </a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}">
                            <div class="flex justify-end">
                                <div class="flex items-center h-10 w-30 rounded-md text-primary font-medium p-2">
                                    <!-- Heroicon name: phone -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                                    </svg>

                                    Registrese
                                </div>
                            </div>
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="h-10 w-30 rounded-md text-primary font-medium p-2"
                        >
                            {{__('Log In')}}
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="h-10 w-30 rounded-md text-primary font-medium p-2"
                            >
                                {{__('Register')}}
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

        </nav>
        <!-- hero seciton -->
        <div class="relative w-full h-[320px]" id="home">
            <div class="absolute inset-0 opacity-80">
                <img src="https://img.freepik.com/premium-photo/motorcycle-self-service-car-wash-banner-copy-space_114106-2200.jpg" alt="Background Image" class="object-cover object-center w-full h-full" />

            </div>
            <div class="absolute inset-9 flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-4 md:mb-0">
                    <h1 class="text-grey-900 font-medium text-4xl md:text-5xl leading-tight mb-2">Bappa Flour mill</h1>
                    <p class="font-regular text-xl mb-8 mt-4">One stop solution for flour grinding services</p>
                    <a href="#contactUs"
                        class="px-6 py-3 bg-[#c8a876] text-white font-medium rounded-full hover:bg-[#c09858]  transition duration-200">Contáctanos</a>
                </div>
            </div>
        </div>

        <!-- our services section -->
        <section class="py-10" id="services">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Nuestros Servicios</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="https://marvel-b1-cdn.bc0a.com/f00000000270514/s25180.pcdn.co/wp-content/uploads/2018/04/Vapor-Car-Wash_Seattle.jpg" alt="wheat flour grinding"
                            class="w-full h-64 object-cover">
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-medium text-gray-800 mb-2">Carwash</h3>
                            <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus deleniti voluptas ex distinctio quam unde debitis consectetur hic, voluptatem, esse facilis accusantium quasi similique ducimus rerum fugit mollitia culpa sit.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRArGmMN-OQNe9LorJJcWzjDmnsRurbxJy6ug&s" alt="Coffee"
                            class="w-full h-64 object-cover">
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-medium text-gray-800 mb-2">Taller</h3>
                            <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis aliquid consequatur, sunt vero recusandae similique quaerat error hic. Totam minus est molestiae aliquam dolores qui fugiat beatae, commodi alias? Consequuntur.</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="https://img.freepik.com/fotos-premium/repuestos-accesorios-automoviles-concepto-taller-servicio-reparacion-automoviles_708636-767.jpg" alt="Coffee"
                            class="w-full h-64 object-cover">
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-medium text-gray-800 mb-2">Repuestos</h3>
                            <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur nostrum voluptatibus non pariatur doloremque quos perferendis quae maiores! Suscipit necessitatibus facilis dolore exercitationem sunt molestias! Quidem a est doloremque nemo.
                            <details>
                                <summary>Read More</summary>
                                <p>Our jowar flour is also
                                    a good source of protein and fiber, making it a healthy choice for your family.</p>
                            </details>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- about us -->
        <section class="bg-gray-100" id="aboutus">
            <div class="container mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">
                    <div class="max-w-lg">
                        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Acerca de Nosotros</h2>
                        <p class="mt-4 text-gray-600 text-lg">
                            Bappa flour mill provides our customers with the highest quality products and services. We offer a
                            wide variety of flours and spices to choose from, and we are always happy to help our customers find
                            the perfect products for their needs.
                            We are committed to providing our customers with the best possible experience. We offer competitive
                            prices, fast shipping, and excellent customer service. We are also happy to answer any questions
                            that our customers may have about our products or services.
                            If you are looking for a flour and spices service business that can provide you with the highest
                            quality products and services, then we are the company for you. We look forward to serving you!</p>
                    </div>
                    <div class="mt-12 md:mt-0">
                        <img src="https://images.unsplash.com/photo-1531973576160-7125cd663d86" alt="About Us Image" class="object-cover rounded-lg shadow-md">
                    </div>
                </div>
            </div>
        </section>

        <!-- why us  -->
        <section class="text-gray-700 body-font mt-10">
            <div class="flex justify-center text-3xl font-bold text-gray-800 text-center">
                ¿Por qué nosotros?
            </div>
            <div class="container px-5 py-12 mx-auto">
                <div class="flex flex-wrap text-center justify-center">
                    <div class="p-4 md:w-1/4 sm:w-1/2">
                        <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                            <div class="flex justify-center">
                                <img src="https://image3.jdomni.in/banner/13062021/58/97/7C/E53960D1295621EFCB5B13F335_1623567851299.png?output-format=webp" class="w-32 mb-3">
                            </div>
                            <h2 class="title-font font-regular text-2xl text-gray-900">Latest Milling Machinery</h2>
                        </div>
                    </div>

                    <div class="p-4 md:w-1/4 sm:w-1/2">
                        <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                            <div class="flex justify-center">
                                <img src="https://image2.jdomni.in/banner/13062021/3E/57/E8/1D6E23DD7E12571705CAC761E7_1623567977295.png?output-format=webp" class="w-32 mb-3">
                            </div>
                            <h2 class="title-font font-regular text-2xl text-gray-900">Reasonable Rates</h2>
                        </div>
                    </div>

                    <div class="p-4 md:w-1/4 sm:w-1/2">
                        <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                            <div class="flex justify-center">
                                <img src="https://image3.jdomni.in/banner/13062021/16/7E/7E/5A9920439E52EF309F27B43EEB_1623568010437.png?output-format=webp" class="w-32 mb-3">
                            </div>
                            <h2 class="title-font font-regular text-2xl text-gray-900">Time Efficiency</h2>
                        </div>
                    </div>

                    <div class="p-4 md:w-1/4 sm:w-1/2">
                        <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                            <div class="flex justify-center">
                                <img src="https://image3.jdomni.in/banner/13062021/EB/99/EE/8B46027500E987A5142ECC1CE1_1623567959360.png?output-format=webp" class="w-32 mb-3">
                            </div>
                            <h2 class="title-font font-regular text-2xl text-gray-900">Expertise in Industry</h2>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- gallery -->
        <section class="text-gray-700 body-font" id="gallery">
            <div class="flex justify-center text-3xl font-bold text-gray-800 text-center py-10">
                Galería
            </div>

            <div class="grid grid-cols-1 place-items-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">

                <div class="group relative">
                    <img
            src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw1fHxuYXR1cmV8ZW58MHwwfHx8MTY5NDA5OTcyOXww&ixlib=rb-4.0.3&q=80&w=1080"
            alt="Image 1"
            class="aspect-[2/3] h-80 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105"
            />
                </div>

                <div class="group relative">
                    <img
            src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw1fHxuYXR1cmV8ZW58MHwwfHx8MTY5NDA5OTcyOXww&ixlib=rb-4.0.3&q=80&w=1080"
            alt="Image 1"
            class="aspect-[2/3] h-80 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105"
            />
                </div>

                <div class="group relative">
                    <img
            src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw1fHxuYXR1cmV8ZW58MHwwfHx8MTY5NDA5OTcyOXww&ixlib=rb-4.0.3&q=80&w=1080"
            alt="Image 1"
            class="aspect-[2/3] h-80 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105"
            />
                </div>
                <div class="group relative">
                    <img
            src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw1fHxuYXR1cmV8ZW58MHwwfHx8MTY5NDA5OTcyOXww&ixlib=rb-4.0.3&q=80&w=1080"
            alt="Image 1"
            class="aspect-[2/3] h-80 object-cover rounded-lg transition-transform transform scale-100 group-hover:scale-105"
            />
                </div>



                <!-- Repeat this div for each image -->
            </div>

        </section>

        <!-- Visit us section -->
        <section class="bg-gray-100">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:py-20 lg:px-8">
                <div class="max-w-2xl lg:max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900" id="contactUs">Visite nuestras sucursales</h2>
                    <p class="mt-3 text-lg text-gray-500">Let us serve you the best</p>
                </div>
                <div class="mt-8 lg:mt-20">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <div class="max-w-full mx-auto rounded-lg overflow-hidden">
                                <div class="border-t border-gray-200 px-6 py-4">
                                    <h3 class="text-lg font-bold text-gray-900">Contacto</h3>
                                    <p class="mt-1 font-bold text-gray-600"><a href="tel:+123">Phone: +91
                                            123456789</a></p>
                                    <a class="flex m-1" href="tel:+919823331842">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="flex items-center justify-between h-10 w-30 rounded-md bg-indigo-500 text-white p-2">
                                                <!-- Heroicon name: phone -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                                </svg>
                                                Llámanos
                                            </div>
                                        </div>

                                    </a>
                                </div>
                                <div class="px-6 py-4">
                                    <h3 class="text-lg font-medium text-gray-900">Nuestra dirección</h3>
                                    <p class="mt-1 text-gray-600">Sale galli, 60 foot road, Latur</p>
                                </div>
                                <div class="border-t border-gray-200 px-6 py-4">
                                    <h3 class="text-lg font-medium text-gray-900">HHorario de atención</h3>
                                    <p class="mt-1 text-gray-600">Monday - Sunday : 2pm - 9pm</p>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-lg overflow-hidden order-none sm:order-first">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3785.7850672491236!2d76.58802159999999!3d18.402630699999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcf83ca88e84341%3A0x841e547bf3ad066d!2zQmFwcGEgZmxvdXIgbWlsbCB8IOCkrOCkquCljeCkquCkviDgpKrgpYDgpKAg4KSX4KS_4KSw4KSj4KWALCDgpK7gpL_gpLDgpJrgpYAg4KSV4KS-4KSC4KSh4KSqIOCkhuCko-CkvyDgpLbgpYfgpLXgpL7gpK_gpL4!5e0!3m2!1sen!2sin!4v1713433597892!5m2!1sen!2sin"
                                class="w-full" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- footer -->
        <section>
            <footer class="bg-gray-200 text-white py-4 px-3">
                <div class="container mx-auto flex flex-wrap items-center justify-between">
                    <div class="w-full md:w-1/2 md:text-center md:mb-4 mb-8">
                        <p class="text-xs text-gray-400 md:text-sm">Copyright 2024 &copy; All Rights Reserved</p>
                    </div>
                    <div class="w-full md:w-1/2 md:text-center md:mb-0 mb-8">
                        <ul class="list-reset flex justify-center flex-wrap text-xs md:text-sm gap-3">
                            <li><a href="#contactUs" class="text-gray-400 hover:text-white">Contact</a></li>
                            <li class="mx-4"><a href="/privacy" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </section>

        <script>
            document.getElementById("hamburger").onclick = function toggleMenu() {
                const navToggle = document.getElementsByClassName("toggle");
                for (let i = 0; i < navToggle.length; i++) {
                navToggle.item(i).classList.toggle("hidden");
                }
            };
        </script>
    </body>
</html>
