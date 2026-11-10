(() => {
  const key = 'oliveCart';
  const readCart = () => { try { return JSON.parse(localStorage.getItem(key) || '[]'); } catch { return []; } };
  const saveCart = (cart) => { localStorage.setItem(key, JSON.stringify(cart)); updateCount(); };
  const format = (n) => `${Math.round(Number(n) || 0).toLocaleString()} MMK`;
  function addPasswordToggles() {
    const eye = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>';
    const eyeOff = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 3 18 18M10.6 10.6a2 2 0 0 0 2.8 2.8"/><path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.4 0 10 7 10 7a15.8 15.8 0 0 1-3.1 3.8M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7c1.2 0 2.3-.2 3.3-.6"/></svg>';
    document.querySelectorAll('input[type="password"]').forEach((input) => {
      if (input.closest('.password-field')) return;
      const field = document.createElement('span'); field.className = 'password-field';
      input.before(field); field.append(input);
      const toggle = document.createElement('button'); toggle.type = 'button'; toggle.className = 'password-toggle';
      toggle.setAttribute('aria-label', 'Show password'); toggle.setAttribute('aria-pressed', 'false'); toggle.innerHTML = eye;
      toggle.addEventListener('click', () => {
        const show = input.type === 'password'; input.type = show ? 'text' : 'password';
        toggle.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        toggle.setAttribute('aria-pressed', String(show)); toggle.innerHTML = show ? eyeOff : eye;
        input.focus({ preventScroll: true });
      });
      field.append(toggle);
    });
  }
  function updateCount() {
    const count = readCart().reduce((sum, item) => sum + (Number(item.quantity) || 0), 0);
    document.querySelectorAll('.cart-count').forEach((node) => { node.textContent = count; node.classList.toggle('is-empty', count === 0); });
  }
  function addItem(item) {
    const cart = readCart(); const found = cart.find((row) => Number(row.id) === Number(item.id));
    if (found) found.quantity = Math.min(20, Number(found.quantity) + 1);
    else cart.push({ ...item, quantity: 1 });
    saveCart(cart);
  }
  document.addEventListener('click', (event) => {
    const add = event.target.closest('.add-to-cart');
    if (add) {
      addItem({ id: Number(add.dataset.id), name: add.dataset.name, price: Number(add.dataset.price), image: add.dataset.image });
      add.classList.add('added'); add.textContent = '✓';
      setTimeout(() => { add.classList.remove('added'); add.textContent = '+'; }, 900);
    }
    const remove = event.target.closest('[data-remove-item]');
    if (remove) { saveCart(readCart().filter((row) => Number(row.id) !== Number(remove.dataset.removeItem))); renderCart(); }
    const qty = event.target.closest('[data-quantity-change]');
    if (qty) {
      const id = Number(qty.dataset.id); const cart = readCart(); const row = cart.find((item) => Number(item.id) === id);
      if (row) { row.quantity = Math.max(1, Math.min(20, Number(row.quantity) + Number(qty.dataset.quantityChange))); saveCart(cart); renderCart(); }
    }
  });
  function renderCart() {
    const container = document.querySelector('#cart-items'); if (!container) return;
    const cart = readCart(); const empty = document.querySelector('#cart-empty'); empty.hidden = cart.length > 0; container.hidden = cart.length === 0;
    container.innerHTML = cart.map((item) => `<article class="cart-row"><img src="${escapeHtml(item.image || '')}" alt=""><div class="cart-row-info"><span class="eyebrow">FROM OUR KITCHEN</span><h3>${escapeHtml(item.name)}</h3><b>${format(item.price)}</b><div class="quantity-control"><button data-quantity-change="-1" data-id="${Number(item.id)}" aria-label="Decrease quantity">−</button><span>${Number(item.quantity)}</span><button data-quantity-change="1" data-id="${Number(item.id)}" aria-label="Increase quantity">+</button></div></div><b class="cart-line-total">${format(Number(item.price) * Number(item.quantity))}</b><button class="remove-item" data-remove-item="${Number(item.id)}" aria-label="Remove ${escapeHtml(item.name)}">×</button></article>`).join('');
    const subtotal = cart.reduce((sum, item) => sum + Number(item.price) * Number(item.quantity), 0);
    const sub = document.querySelector('#cart-subtotal'); const total = document.querySelector('#cart-total'); if (sub) sub.textContent = format(subtotal); if (total) total.textContent = format(subtotal);
  }
  function escapeHtml(value) { return String(value).replace(/[&<>"']/g, (ch) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[ch])); }

  const search = document.querySelector('#menu-search'); const cards = [...document.querySelectorAll('.menu-card')]; let selectedCategory = 'all';
  function filterMenu() { const term = (search?.value || '').trim().toLowerCase(); cards.forEach((card) => { card.hidden = !(selectedCategory === 'all' || card.dataset.category === selectedCategory) || !card.dataset.name.includes(term); }); }
  document.querySelectorAll('.filter-chip').forEach((button) => button.addEventListener('click', () => { document.querySelector('.filter-chip.active')?.classList.remove('active'); button.classList.add('active'); selectedCategory = button.dataset.category; filterMenu(); }));
  search?.addEventListener('input', filterMenu);
  const navToggle = document.querySelector('.nav-toggle'); navToggle?.addEventListener('click', () => { const nav = document.querySelector('.main-nav'); const open = nav.classList.toggle('open'); navToggle.setAttribute('aria-expanded', String(open)); });
  const url = new URL(window.location.href);
  if (url.searchParams.get('ordered') === '1') {
    localStorage.removeItem(key); url.searchParams.delete('ordered');
    history.replaceState({}, '', url);
  }
  addPasswordToggles(); updateCount(); renderCart();
})();
