{{-- Catppuccin flavor + accent switcher --}}
<style>
  .ctp-switcher { position: fixed; left: 16px; bottom: 16px; z-index: 10; font-family: inherit; }
  .ctp-toggle {
    width: 44px; height: 44px; padding: 0; margin: 0; border-radius: 50%; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: var(--ctp-text); background: var(--ctp-surface0); border: 1px solid var(--ctp-surface2);
    line-height: 1;
  }
  .ctp-toggle:hover, .ctp-toggle:focus-visible { background: var(--ctp-surface1); border-color: var(--accent); outline: none; color: var(--ctp-text); }
  .ctp-toggle svg { width: 22px; height: 22px; fill: currentColor; }
  .ctp-panel {
    position: absolute; left: 0; bottom: 56px; width: 264px; box-sizing: border-box; padding: 14px;
    text-align: left; font-size: 14px; line-height: 20px;
    color: var(--ctp-text); background: var(--ctp-mantle);
    border: 1px solid var(--ctp-surface1); border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
  }
  .ctp-panel[hidden] { display: none; }
  .ctp-label { margin: 0 0 8px; font-size: 12px; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--ctp-subtext0); }
  .ctp-label + .ctp-row { margin-bottom: 14px; }
  .ctp-row { display: flex; flex-wrap: wrap; gap: 8px; }
  .ctp-panel button {
    width: auto; height: auto; margin: 0; cursor: pointer; font: inherit; letter-spacing: 0;
    color: var(--ctp-text); background: var(--ctp-surface0); border: 2px solid transparent; border-radius: 8px;
  }
  .ctp-flavor { display: flex; align-items: center; gap: 6px; padding: 5px 9px; font-size: 13px; font-weight: 600; line-height: 18px; }
  .ctp-flavor i { width: 14px; height: 14px; border-radius: 50%; border: 1px solid var(--ctp-overlay0); }
  .ctp-panel .ctp-dot { width: 24px; height: 24px; padding: 0; border-radius: 50%; }
  .ctp-panel button:hover { background: var(--ctp-surface1); }
  .ctp-panel .ctp-dot:hover { background: none; }
  .ctp-panel button:focus-visible { outline: 2px solid var(--ctp-blue); outline-offset: 2px; }
  .ctp-panel button[aria-pressed="true"] { border-color: var(--accent); }
  .ctp-panel .ctp-dot[aria-pressed="true"] { border-color: var(--ctp-text); box-shadow: inset 0 0 0 2px var(--ctp-mantle); }
</style>

<div class="ctp-switcher" id="ctp-switcher">
  <button type="button" class="ctp-toggle" id="ctp-toggle" aria-label="Change theme colors" aria-expanded="false" aria-controls="ctp-panel">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 0 0 0 20c1.1 0 2-.9 2-2 0-.5-.2-1-.5-1.3-.3-.3-.5-.8-.5-1.2 0-1.1.9-2 2-2h2.3A4.7 4.7 0 0 0 22 10.8C22 5.9 17.5 2 12 2zM6.5 12a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm3-4a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm3 4a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/></svg>
  </button>
  <div class="ctp-panel" id="ctp-panel" role="group" aria-label="Catppuccin colors" hidden></div>
</div>

<script>
(function () {
  var FLAVORS = [
    ['auto', 'Auto', null],
    ['latte', 'Latte', '#eff1f5'],
    ['frappe', 'Frappé', '#303446'],
    ['macchiato', 'Macchiato', '#24273a'],
    ['mocha', 'Mocha', '#1e1e2e']
  ];
  var ACCENTS = ['rosewater', 'flamingo', 'pink', 'mauve', 'red', 'maroon', 'peach', 'yellow', 'green', 'teal', 'sky', 'sapphire', 'blue', 'lavender'];
  var root = document.documentElement;
  var panel = document.getElementById('ctp-panel');
  var toggle = document.getElementById('ctp-toggle');
  var box = document.getElementById('ctp-switcher');
  if (!panel || !toggle || !box) return;

  function store(key, value) {
    try {
      if (value) localStorage.setItem(key, value); else localStorage.removeItem(key);
    } catch (e) {}
  }
  function label(text) {
    var p = document.createElement('p');
    p.className = 'ctp-label';
    p.textContent = text;
    return p;
  }
  function refresh() {
    var f = root.getAttribute('data-flavor') || 'auto';
    var a = root.getAttribute('data-accent') || 'mauve';
    Array.prototype.forEach.call(panel.querySelectorAll('[data-flavor-btn]'), function (b) {
      b.setAttribute('aria-pressed', String(b.getAttribute('data-flavor-btn') === f));
    });
    Array.prototype.forEach.call(panel.querySelectorAll('[data-accent-btn]'), function (b) {
      b.setAttribute('aria-pressed', String(b.getAttribute('data-accent-btn') === a));
    });
  }

  panel.appendChild(label('Flavor'));
  var flavorRow = document.createElement('div');
  flavorRow.className = 'ctp-row';
  FLAVORS.forEach(function (f) {
    var b = document.createElement('button');
    b.type = 'button';
    b.className = 'ctp-flavor';
    b.setAttribute('data-flavor-btn', f[0]);
    if (f[2]) {
      var sw = document.createElement('i');
      sw.style.background = f[2];
      b.appendChild(sw);
    }
    b.appendChild(document.createTextNode(f[1]));
    b.addEventListener('click', function () {
      if (f[0] === 'auto') root.removeAttribute('data-flavor'); else root.setAttribute('data-flavor', f[0]);
      store('ctp-flavor', f[0] === 'auto' ? null : f[0]);
      refresh();
    });
    flavorRow.appendChild(b);
  });
  panel.appendChild(flavorRow);

  panel.appendChild(label('Accent'));
  var accentRow = document.createElement('div');
  accentRow.className = 'ctp-row';
  ACCENTS.forEach(function (a) {
    var b = document.createElement('button');
    b.type = 'button';
    b.className = 'ctp-dot';
    b.style.background = 'var(--ctp-' + a + ')';
    b.title = a.charAt(0).toUpperCase() + a.slice(1);
    b.setAttribute('aria-label', b.title);
    b.setAttribute('data-accent-btn', a);
    b.addEventListener('click', function () {
      root.setAttribute('data-accent', a);
      store('ctp-accent', a === 'mauve' ? null : a);
      refresh();
    });
    accentRow.appendChild(b);
  });
  panel.appendChild(accentRow);

  function setOpen(open) {
    panel.hidden = !open;
    toggle.setAttribute('aria-expanded', String(open));
  }
  toggle.addEventListener('click', function () { setOpen(panel.hidden); });
  document.addEventListener('click', function (e) { if (!box.contains(e.target)) setOpen(false); });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !panel.hidden) { setOpen(false); toggle.focus(); }
  });
  refresh();
})();
</script>
