// SarkariCourse — Global Header interactions (Phase 2)
document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('scHeader');
    const drawer = document.getElementById('scDrawer');
    const drawerOverlay = document.getElementById('scDrawerOverlay');
    const drawerTrigger = document.getElementById('scDrawerTrigger');
    const drawerClose = document.getElementById('scDrawerClose');
    const searchOverlay = document.getElementById('scSearchOverlay');
    const searchTrigger = document.getElementById('scSearchTrigger');
    const searchTriggerMobile = document.getElementById('scSearchTriggerMobile');
    const searchClose = document.getElementById('scSearchClose');
    const searchInput = document.getElementById('scSearchInput');
    const userMenu = document.querySelector('.sc-user-menu');
    const userTrigger = document.getElementById('scUserTrigger');
    const recentBox = document.getElementById('scRecentSearches');
    const recentList = document.getElementById('scRecentSearchesList');

    // Sticky header shadow on scroll
    const onScroll = () => {
        if (window.scrollY > 12) header?.classList.add('is-scrolled');
        else header?.classList.remove('is-scrolled');
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Drawer open/close
    const openDrawer = () => {
        drawer?.classList.add('open');
        drawerOverlay?.classList.add('open');
        drawer?.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    };
    const closeDrawer = () => {
        drawer?.classList.remove('open');
        drawerOverlay?.classList.remove('open');
        drawer?.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    };
    drawerTrigger?.addEventListener('click', openDrawer);
    drawerClose?.addEventListener('click', closeDrawer);
    drawerOverlay?.addEventListener('click', closeDrawer);

    // Search overlay
    const RECENT_KEY = 'sc_recent_searches';
    const getRecent = () => { try { return JSON.parse(localStorage.getItem(RECENT_KEY)) || []; } catch { return []; } };
    const saveRecent = (term) => {
        if (!term) return;
        let list = getRecent().filter((t) => t.toLowerCase() !== term.toLowerCase());
        list.unshift(term);
        localStorage.setItem(RECENT_KEY, JSON.stringify(list.slice(0, 5)));
    };
    const renderRecent = () => {
        const list = getRecent();
        if (!recentBox || !recentList) return;
        if (!list.length) { recentBox.hidden = true; return; }
        recentBox.hidden = false;
        recentList.innerHTML = list.map((t) =>
            `<button type="button" class="sc-search-chip" data-term="${t.replace(/"/g, '&quot;')}">🕐 ${t}</button>`
        ).join('');
    };

    const openSearch = () => {
        searchOverlay?.classList.add('open');
        renderRecent();
        setTimeout(() => searchInput?.focus(), 150);
        document.body.style.overflow = 'hidden';
    };
    const closeSearch = () => {
        searchOverlay?.classList.remove('open');
        document.body.style.overflow = '';
    };
    searchTrigger?.addEventListener('click', openSearch);
    searchTriggerMobile?.addEventListener('click', openSearch);
    searchClose?.addEventListener('click', closeSearch);
    searchOverlay?.addEventListener('click', (e) => { if (e.target === searchOverlay) closeSearch(); });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') { closeSearch(); closeDrawer(); }
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') { e.preventDefault(); openSearch(); }
    });

    // Search chips (recent + popular) fill the input and submit
    document.addEventListener('click', (e) => {
        const chip = e.target.closest('.sc-search-chip');
        if (chip && searchInput) {
            searchInput.value = chip.dataset.term;
            searchInput.closest('form')?.submit();
        }
    });
    searchInput?.closest('form')?.addEventListener('submit', () => saveRecent(searchInput.value.trim()));

    // User dropdown
    userTrigger?.addEventListener('click', (e) => {
        e.stopPropagation();
        userMenu?.classList.toggle('open');
    });
    document.addEventListener('click', () => userMenu?.classList.remove('open'));
});
