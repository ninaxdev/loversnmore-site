/* ================================================================
   LoversNmore Icebreakers — play view
   Two-card reveal system:
     - Both cards live in the DOM at all times.
     - "current" is interactive on top, "next" sits directly behind.
     - On advance the roles swap, and the outgoing card is reloaded
       with the following question and placed as the new "next".
   Expects a global `window.__IB_CARDS` set by play.blade.php:
     [{ q: "text", cat: "TAG" }, ...]
   ================================================================ */
(function () {
  var data = window.__IB_CARDS;
  if (!Array.isArray(data) || data.length === 0) return;

  var cardA = document.querySelector('.ib-play-card[data-slot="a"]');
  var cardB = document.querySelector('.ib-play-card[data-slot="b"]');
  if (!cardA || !cardB) return;
  var bothCards = [cardA, cardB];

  var state = {
    order: shuffle(data.length),
    pos: 0,
    saved: new Set()
  };

  var els = {
    counter: document.getElementById('ibCounter'),
    counterTotal: document.getElementById('ibCounterTotal'),
    saveBtn: document.getElementById('ibSaveBtn'),
    passBtn: document.getElementById('ibPassBtn'),
    nextBtn: document.getElementById('ibNextBtn'),
    endBlock: document.getElementById('ibEndBlock'),
    playBlock: document.getElementById('ibPlayBlock'),
    shuffleBtn: document.getElementById('ibShuffleBtn')
  };

  var PURPLE_TAGS = ['GO DEEP', 'IMAGINE', 'REMEMBER WHEN', 'DO SOMETHING', 'PICK ONE'];

  /* ------------------------ helpers ------------------------ */
  function shuffle(n) {
    var arr = [];
    for (var i = 0; i < n; i++) arr.push(i);
    for (var i = arr.length - 1; i > 0; i--) {
      var j = Math.floor(Math.random() * (i + 1));
      var tmp = arr[i]; arr[i] = arr[j]; arr[j] = tmp;
    }
    return arr;
  }

  function currentCard() { return document.querySelector('.ib-play-card[data-role="current"]'); }
  function nextCard()    { return document.querySelector('.ib-play-card[data-role="next"]'); }

  function populate(cardEl, cardData) {
    cardEl.querySelector('.js-question').textContent = cardData.q;
    var cat = cardEl.querySelector('.js-category');
    cat.textContent = cardData.cat;
    var usesPurple = PURPLE_TAGS.indexOf(cardData.cat) >= 0;
    cat.classList.toggle('variant-purple', usesPurple);
  }

  function refreshCounter() {
    if (els.counter) els.counter.textContent = String(state.pos + 1).padStart(2, '0');
  }
  function refreshSaveBtn() {
    if (!els.saveBtn) return;
    var key = state.order[state.pos];
    els.saveBtn.classList.toggle('is-saved', state.saved.has(key));
  }
  function refreshBehindLayers() {
    var cardsAfterNext = state.order.length - state.pos - 2;
    document.querySelectorAll('.ib-behind-layer').forEach(function (el) {
      var i = parseInt(el.dataset.i, 10);
      el.style.opacity = (cardsAfterNext > i) ? '1' : '0';
    });
  }

  /* ------------------------ init ------------------------ */
  function start() {
    state.order = shuffle(data.length);
    state.pos = 0;
    state.saved = new Set();

    bothCards.forEach(function (c) {
      c.classList.remove('is-flipped', 'leaving-left', 'leaving-right', 'dragging', 'is-hidden');
      c.style.transform = '';
    });
    cardA.dataset.role = 'current';
    cardB.dataset.role = 'next';

    populate(cardA, data[state.order[0]]);
    if (data.length > 1) {
      populate(cardB, data[state.order[1]]);
      cardB.classList.remove('is-hidden');
    } else {
      cardB.classList.add('is-hidden');
    }

    if (els.counterTotal) els.counterTotal.textContent = String(data.length).padStart(2, '0');
    if (els.endBlock)     els.endBlock.hidden = true;
    if (els.playBlock)    els.playBlock.hidden = false;

    refreshCounter();
    refreshSaveBtn();
    refreshBehindLayers();
  }

  /* ------------------------ advance ------------------------ */
  function advance(direction) {
    var outgoing = currentCard();
    var incoming = nextCard();
    if (!outgoing) return;

    outgoing.classList.remove('is-flipped');
    outgoing.classList.add(direction === 'left' ? 'leaving-left' : 'leaving-right');
    outgoing.style.transform = '';

    setTimeout(function () {
      state.pos++;
      if (state.pos >= data.length) {
        showEnd();
        return;
      }

      // Promote incoming → current
      incoming.dataset.role = 'current';
      incoming.classList.remove('is-flipped', 'leaving-left', 'leaving-right', 'dragging', 'is-hidden');
      incoming.style.transform = '';

      // Reset outgoing → new next
      outgoing.dataset.role = 'next';
      outgoing.classList.remove('leaving-left', 'leaving-right', 'is-flipped', 'dragging');
      outgoing.style.transform = '';

      var nextIdx = state.pos + 1;
      if (nextIdx < data.length) {
        populate(outgoing, data[state.order[nextIdx]]);
        outgoing.classList.remove('is-hidden');
      } else {
        outgoing.classList.add('is-hidden');
      }

      refreshCounter();
      refreshSaveBtn();
      refreshBehindLayers();
    }, 460);
  }

  function showEnd() {
    if (els.endBlock)  els.endBlock.hidden = false;
    if (els.playBlock) els.playBlock.hidden = true;
    window.scrollTo({ top: 0, behavior: 'instant' });
  }

  /* ------------------------ button handlers ------------------------ */
  if (els.nextBtn)    els.nextBtn.addEventListener('click', function () { advance('right'); });
  if (els.passBtn)    els.passBtn.addEventListener('click', function () { advance('left'); });
  if (els.shuffleBtn) els.shuffleBtn.addEventListener('click', function () { start(); });

  if (els.saveBtn) {
    els.saveBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      var key = state.order[state.pos];
      if (state.saved.has(key)) state.saved.delete(key);
      else state.saved.add(key);
      refreshSaveBtn();
    });
  }

  /* ------------------------ per-card interactions ------------------------ */
  function attachCardHandlers(cardEl) {
    cardEl.addEventListener('click', function () {
      if (cardEl.dataset.role !== 'current') return;
      if (cardEl.dataset.suppressClick === '1') { delete cardEl.dataset.suppressClick; return; }
      cardEl.classList.toggle('is-flipped');
    });

    var sx = 0, sy = 0, dx = 0, dragging = false, dragMoved = false;
    cardEl.addEventListener('pointerdown', function (e) {
      if (cardEl.dataset.role !== 'current') return;
      if (cardEl.classList.contains('leaving-left') || cardEl.classList.contains('leaving-right')) return;
      dragging = true; dragMoved = false;
      sx = e.clientX; sy = e.clientY; dx = 0;
      cardEl.classList.add('dragging');
      try { cardEl.setPointerCapture(e.pointerId); } catch (err) {}
    });
    cardEl.addEventListener('pointermove', function (e) {
      if (!dragging) return;
      var cdx = e.clientX - sx;
      var cdy = e.clientY - sy;
      if (!dragMoved && Math.abs(cdy) > Math.abs(cdx) && Math.abs(cdy) > 8) {
        dragging = false;
        cardEl.classList.remove('dragging');
        cardEl.style.transform = '';
        return;
      }
      if (Math.abs(cdx) > 5) dragMoved = true;
      dx = cdx;
      cardEl.style.transform = 'translateX(' + cdx + 'px) rotate(' + (cdx / 20) + 'deg)';
    });
    cardEl.addEventListener('pointerup', function () {
      if (!dragging) return;
      dragging = false;
      cardEl.classList.remove('dragging');
      if (dragMoved) cardEl.dataset.suppressClick = '1';
      if (dx > 90)       advance('right');
      else if (dx < -90) advance('left');
      else cardEl.style.transform = '';
    });
    cardEl.addEventListener('pointercancel', function () {
      dragging = false;
      cardEl.classList.remove('dragging');
      cardEl.style.transform = '';
    });
  }
  bothCards.forEach(attachCardHandlers);

  document.addEventListener('keydown', function (e) {
    if (els.endBlock && !els.endBlock.hidden) return;
    if (e.key === 'ArrowRight')                 { e.preventDefault(); advance('right'); }
    else if (e.key === 'ArrowLeft')             { e.preventDefault(); advance('left'); }
    else if (e.key === ' ' || e.key === 'Enter'){ e.preventDefault(); var c = currentCard(); if (c) c.classList.toggle('is-flipped'); }
  });

  /* Boot */
  start();
})();
