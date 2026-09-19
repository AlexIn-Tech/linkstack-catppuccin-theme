{{-- 


|--------------------------------------------------------------------------
| Custom assets
|--------------------------------------------------------------------------

Custom assets are stored in the 'custom-assets' directory found inside the 'extra' folder.
Custom assets can be any file you would like to use in your theme.
For example: JS, CSS or image files.

You can load these custom assets with a built-in function, 'themeAsset()'.
Add the file you want to add to your 'custom-assets' folder, and include the name with the file extension in the function.

Down below, you can find a few examples using this function:

<link rel="stylesheet" href="{{themeAsset('your.css')}}">
<script src="{{themeAsset('your.js')}}"></script>
<style>body{background-image: url({{themeAsset('your.png')}});}</style>

--}}

{{-- Apply the saved Catppuccin flavor/accent before first paint to avoid a flash --}}
<script>
(function () {
  try {
    var d = document.documentElement;
    var f = localStorage.getItem('ctp-flavor');
    var a = localStorage.getItem('ctp-accent');
    if (['latte', 'frappe', 'macchiato', 'mocha'].indexOf(f) > -1) d.setAttribute('data-flavor', f);
    if (['rosewater', 'flamingo', 'pink', 'mauve', 'red', 'maroon', 'peach', 'yellow', 'green', 'teal', 'sky', 'sapphire', 'blue', 'lavender'].indexOf(a) > -1) d.setAttribute('data-accent', a);
  } catch (e) {}
})();
</script>
