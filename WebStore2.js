const DEFAULT_CONFIG = {
    storeName: "Digital Premium",
    contact: "https://t.me/Mr_Redbunny",
    favicon: "https://i.postimg.cc/4y0CHYHF/dp.jpg",
    ogImage: "https://i.postimg.cc/4y0CHYHF/dp.jpg",
    ogTitle: "Digital Premium Store",
    ogDesc: "Pusat Produk Digital Termurah & Terpercaya",
    banners: [
        "https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=800&q=80",
        "https://images.unsplash.com/photo-1557821552-17105176677c?w=800&q=80"
    ],
    cats: ["Semua", "Streaming", "App", "Game"]
  };

  // --- ICONS (SVG) ---
  const ICONS = {
    chat: `<svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>`,
    cart: `<svg viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>`,
    history: `<svg viewBox="0 0 24 24"><path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z"/></svg>`,
    wallet: `<svg viewBox="0 0 24 24"><path d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>`,
    user: `<svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>`,
    search: `<svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>`,
    filter: `<svg viewBox="0 0 24 24"><path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/></svg>`,
    close: `<svg viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>`,
    check: `<svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>`,
    back: `<svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>`,
    edit: `<svg viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>`,
    next: `<svg viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>`,
    help: `<svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/></svg>`,
    telegram: `<svg viewBox="0 0 24 24"><path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71L12.6 16.3l-1.99 1.93c-.23.23-.42.42-.83.42z"/></svg>`,
    trash: `<svg viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>`,
    logout: `<svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>`,
    copy: `<svg viewBox="0 0 24 24"><path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/></svg>`,
    bag: `<svg viewBox="0 0 24 24"><path d="M18 6h-2c0-2.21-1.79-4-4-4S8 3.79 8 6H6c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-6-2c1.1 0 2 .9 2 2H10c0-1.1.9-2 2-2zm6 16H6V8h2v2c0 .55.45 1 1 1s1-.45 1-1V8h4v2c0 .55.45 1 1 1s1-.45 1-1V8h2v12z"/></svg>`,
    settings: `<svg viewBox="0 0 24 24"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58a.49.49 0 0 0 .12-.61l-1.92-3.32a.488.488 0 0 0-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54a.484.484 0 0 0-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58a.49.49 0 0 0-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>`,
    tag: `<svg viewBox="0 0 24 24"><path d="M20 12l-1.41-1.41L13 16.17V4h-2v12.17l-5.58-5.59L4 12l8 8 8-8z"/></svg>`,
    eye: `<svg viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>`,
    camera: `<svg viewBox="0 0 24 24"><path d="M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/></svg>`,
    info: `<svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>`,
    chart: `<svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>`,
    chevronDown: `<svg viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>`,
    ticket: `<svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v4c1.1 0 2 .9 2 2s-.9 2-2 2v4c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-4c-1.1 0-2-.9-2-2s.9-2 2-2V6c0-1.1-.9-2-2-2zm0 14H4v-1.5c1.93 0 3.5-1.57 3.5-3.5S5.93 9.5 4 9.5V6h16v1.5c-1.93 0-3.5 1.57-3.5 3.5s1.57 3.5 3.5 3.5V18z"/></svg>`,
    plus: `<svg viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>`,
    menu: `<svg viewBox="0 0 24 24"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>`
  };

  const HTML_PART_1 = `
  <!DOCTYPE html>
  <html lang="id">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <title>${DEFAULT_CONFIG.storeName}</title>
      <link rel="shortcut icon" href="{{STORE_FAVICON}}">
      <meta property="og:title" content="{{OG_TITLE}}">
      <meta property="og:description" content="{{OG_DESC}}">
      <meta property="og:image" content="{{OG_IMAGE}}">
      <meta property="og:type" content="website">
      <meta name="theme-color" content="#ffffff">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
      <style>
          :root {
              --bg: #F9FAFB;
              --card-bg: #FFFFFF;
              --input-bg: #F3F4F6;
              --primary: #2563EB;
              --text: #1F2937;
              --text-muted: #6B7280;
              --border: #E5E7EB;
              --glass: rgba(255, 255, 255, 0.95);
              --danger: #EF4444;
              --success: #10B981;
              --warning: #F59E0B;
              --code-font: 'Fira Code', monospace;
              --shadow-sm: 0 1px 3px 0 rgba(0,0,0,0.1), 0 1px 2px 0 rgba(0,0,0,0.06);
              --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
              --radius-md: 12px;
          }

          * { box-sizing: border-box; outline: none; -webkit-tap-highlight-color: transparent; }
          body { background: var(--bg); color: var(--text); font-family: 'Inter', sans-serif; margin: 0; padding: 0; padding-bottom: 80px; font-size: 14px; }
          svg { width: 20px; height: 20px; fill: currentColor; }

          /* HEADER */
          .navbar { position: fixed; top: 0; left: 0; width: 100%; background: var(--glass); backdrop-filter: blur(10px); z-index: 50; padding: 10px 15px; display: flex; justify-content: space-between; align-items: center; box-shadow: var(--shadow-sm); }
          .nav-brand { font-weight: 800; font-size: 1.1rem; color: var(--primary); letter-spacing: -0.5px; }

          /* BANNER */
          .banner-container { margin-top: 60px; padding: 0 15px; position: relative; max-width: 1200px; margin-left: auto; margin-right: auto; }
          .banner-slider { display: flex; overflow-x: auto; scroll-snap-type: x mandatory; scroll-behavior: smooth; -webkit-overflow-scrolling: touch; border-radius: 16px; box-shadow: var(--shadow-md); }
          .banner-slider::-webkit-scrollbar { display: none; }
          .banner-slide { min-width: 100%; scroll-snap-align: center; position: relative; }
          .banner-img { width: 100%; aspect-ratio: 2/1; object-fit: cover; display: block; background: #E5E7EB; }
          .banner-dots { display: flex; justify-content: center; gap: 6px; position: absolute; bottom: 12px; left: 0; width: 100%; pointer-events: none; }
          .dot { width: 6px; height: 6px; border-radius: 50%; background: rgba(255,255,255,0.5); transition: 0.3s; }
          .dot.active { background: white; width: 18px; border-radius: 10px; }

          /* CONTROLS */
          .controls { display: flex; gap: 10px; max-width: 1200px; margin: 15px auto 10px; padding: 0 15px; }
          .search-wrapper { position: relative; flex-grow: 1; }
          .search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); width: 16px; height: 16px; }
          .search-box { width: 100%; background: var(--input-bg); border: none; border-radius: 8px; padding: 10px 10px 10px 38px; color: var(--text); font-size: 0.9rem; }
          .filter-btn { background: white; border: 1px solid var(--border); border-radius: 8px; width: 40px; display: flex; align-items: center; justify-content: center; color: var(--text); cursor: pointer; flex-shrink: 0; }

          .cat-scroll { display: flex; gap: 8px; overflow-x: auto; padding: 5px 15px 15px; scrollbar-width: none; max-width: 1200px; margin: 0 auto; }
          .cat-scroll::-webkit-scrollbar { display: none; }
          .cat-pill { background: white; border: 1px solid var(--border); padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; color: var(--text-muted); white-space: nowrap; cursor: pointer; transition: 0.2s; }
          .cat-pill.active { background: var(--primary); color: white; border-color: var(--primary); font-weight: 600; }

          /* PRODUCT GRID */
          .container { max-width: 1200px; margin: 0 auto; padding: 0 15px; }
          .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
          @media (min-width: 768px) { .grid { grid-template-columns: repeat(5, 1fr); gap: 20px; } }

          .card { background: white; border-radius: var(--radius-md); overflow: hidden; display: flex; flex-direction: column; cursor: pointer; transition: 0.2s; box-shadow: var(--shadow-sm); border: 1px solid #f0f0f0; }
          .card:active { transform: scale(0.98); }
          .prod-img-container { width: 100%; padding-top: 100%; position: relative; background: #f9f9f9; }
          .prod-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }
          .badge-overlay { position: absolute; top: 6px; left: 6px; z-index: 10; display:flex; flex-direction:column; gap:4px; }
          .lbl { font-size: 0.6rem; padding: 2px 6px; border-radius: 4px; font-weight: 700; text-transform: uppercase; }
          .lbl-stock { background: rgba(0,0,0,0.6); color: white; backdrop-filter: blur(2px); }

          .card-content { padding: 10px; flex-grow: 1; display: flex; flex-direction: column; }
          .card h4 { font-size: 0.85rem; font-weight: 700; margin: 0 0 4px 0; color: var(--text); overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.3; height: 2.6em; }
          .stock { font-size: 0.7rem; color: var(--text-muted); margin-bottom: 6px; }
          .price { color: var(--primary); font-weight: 800; font-size: 1rem; }
          .btn-mini { margin-top: 8px; background: var(--input-bg); color: var(--text); border: none; border-radius: 6px; padding: 6px; font-size: 0.75rem; font-weight: 600; width: 100%; }
          .btn-mini.active { background: var(--primary); color: white; }

          /* BOTTOM NAVIGATION */
          .bottom-nav { position: fixed; bottom: 0; left: 0; width: 100%; background: white; border-top: 1px solid #E5E7EB; padding: 8px 0 20px; display: flex; justify-content: space-around; align-items: center; z-index: 1000; padding-bottom: calc(10px + env(safe-area-inset-bottom)); }
          .nav-item { display: flex; flex-direction: column; align-items: center; justify-content: center; flex: 1; color: var(--text-muted); cursor: pointer; transition: 0.2s; -webkit-tap-highlight-color: transparent; }
          .nav-item svg { width: 22px; height: 22px; margin-bottom: 4px; fill: currentColor; }
          .nav-item span { font-size: 0.7rem; font-weight: 500; }
          .nav-item.active { color: var(--primary); }

          .admin-float-btn { position:fixed; bottom:80px; left:15px; width:45px; height:45px; background:white; border:none; border-radius:50%; display:none; align-items:center; justify-content:center; z-index:4100; box-shadow: var(--shadow-md); cursor:pointer; color:var(--text-muted); }
          .admin-float-btn:active { transform:scale(0.9); }
          .tg-float { display: none !important; }

          /* MODALS */
          .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.4); backdrop-filter: blur(4px); z-index: 5500; align-items: center; justify-content: center; opacity: 0; transition: all 0.3s ease; }
          .modal.active { display: flex; opacity: 1; }
          .modal-content { background: white; border-radius: 20px; width: 90%; max-width: 420px; padding: 25px; position: relative; box-shadow: 0 20px 50px rgba(0,0,0,0.1); transform: scale(0.95); transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94); max-height: 85vh; overflow-y: auto; color: var(--text); border: 1px solid #E5E7EB; }
          .modal.active .modal-content { transform: scale(1); }
          .close-icon { position: absolute; top: 12px; right: 12px; color: var(--text-muted); cursor: pointer; background: #F3F4F6; width: 32px; height: 32px; display:flex; align-items:center; justify-content:center; border-radius:50%; transition: 0.2s; }
          .close-icon:hover { background: #E5E7EB; color: var(--text); }

          /* FULLSCREEN MODAL */
          .fs-modal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: var(--bg); z-index: 5000; transform: translateX(100%); transition: transform 0.3s cubic-bezier(0.4, 0.0, 0.2, 1); display: flex; flex-direction: column; }
          .fs-modal.active { transform: translateX(0); }
          .fs-header { padding: 15px; background: white; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; font-weight: 700; color:var(--text); box-shadow: var(--shadow-sm); }
          .fs-back-btn { background: none; border: none; cursor: pointer; padding: 5px; color:var(--text); }
          .fs-content { padding: 15px; overflow-y: auto; flex: 1; }

          .fs-profile-card { background: white; border-radius: 16px; padding: 20px; display: flex; align-items: center; gap: 15px; margin-bottom: 20px; border: 1px solid var(--border); }
          .fs-avatar { width: 50px; height: 50px; border-radius: 50%; background: var(--input-bg); display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.2rem; font-weight: bold; border: 2px solid var(--primary); background-size: cover; background-position: center; }

          .fs-menu-item { padding: 15px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--border); cursor: pointer; font-size: 0.9rem; background: white; }
          .fs-menu-item:first-child { border-top-left-radius: 12px; border-top-right-radius: 12px; }
          .fs-menu-item:last-child { border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; border-bottom: none; }
          .fs-menu-group { margin-bottom: 20px; border: 1px solid var(--border); border-radius: 12px; }

          /* ADMIN UI FIXED */
          .admin-container { display: flex; height: 100%; overflow: hidden; background: #F3F4F6; }
          .admin-sidebar { width: 60px; background: white; border-right: 1px solid #E5E7EB; display: flex; flex-direction: column; align-items: center; padding-top: 20px; gap: 20px; flex-shrink: 0; z-index: 10; }
          .admin-content { flex: 1; overflow-y: auto; padding: 15px; }
          .admin-card { background: white; border-radius: 12px; padding: 20px; margin-bottom: 15px; box-shadow: var(--shadow-sm); border: 1px solid #E5E7EB; }
          .admin-card-title { font-size: 1rem; font-weight: 700; margin-bottom: 15px; color: var(--primary); display: flex; align-items: center; gap: 8px; border-bottom: 1px solid #F3F4F6; padding-bottom: 10px; }

          .sidebar-item { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 10px; color: var(--text-muted); cursor: pointer; transition: 0.2s; }
          .sidebar-item.active { background: var(--primary); color: white; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3); }
          .sidebar-label { display: none; }

          .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
          @media (max-width: 768px) { .form-grid.responsive { grid-template-columns: 1fr; } }
          .form-group { margin-bottom: 15px; }
          .form-label { display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 600; }
          .input-field { width: 100%; background: #fff; border: 1px solid #E5E7EB; padding: 12px; border-radius: 8px; margin-bottom: 0; color: var(--text); font-size: 0.95rem; }
          .input-field:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }

          .accordion { background: white; border: 1px solid #E5E7EB; border-radius: 10px; margin-bottom: 10px; overflow: hidden; }
          .accordion-header { padding: 15px; font-weight: 600; display: flex; justify-content: space-between; align-items: center; cursor: pointer; background: #F9FAFB; font-size: 0.95rem; }
          .accordion-content { padding: 0 15px; max-height: 0; overflow: hidden; transition: max-height 0.3s; opacity: 0; background: white; }
          .accordion.open .accordion-content { padding: 20px 15px; max-height: 1000px; opacity: 1; }

          .btn-primary { width: 100%; background: var(--primary); color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 700; font-size: 0.95rem; cursor: pointer; margin-bottom: 10px; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2); transition: 0.2s; }
          .btn-primary:active { transform: scale(0.98); }
          .btn-secondary { width: 100%; background: var(--input-bg); color: var(--text); border: none; padding: 12px; border-radius: 10px; font-weight: 600; cursor: pointer; }
          .btn-danger { width: 100%; background: var(--danger); color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 700; cursor: pointer; }

          .tag-container { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 10px; }
          .tag { background: #fff; border: 1px solid #E5E7EB; padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; display: flex; align-items: center; gap: 6px; box-shadow: var(--shadow-sm); }

          .toast-container { position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 6000; width: 90%; max-width: 380px; }
          .toast { background: #333; color: white; padding: 14px 20px; border-radius: 12px; margin-bottom: 10px; font-size: 0.9rem; font-weight: 600; display: flex; align-items: center; gap: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); transform: translateY(-20px); opacity: 0; animation: toast-in 0.5s forwards; }
          .toast.success svg { color: var(--success); }
          .toast.error svg { color: var(--danger); }
          @keyframes toast-in { to { transform: translateY(0); opacity: 1; } }
          @keyframes toast-out { from { transform: translateY(0); opacity: 1; } to { transform: translateY(-20px); opacity: 0; } }

          .loader { width: 24px; height: 24px; border: 3px solid #eee; border-top-color: var(--primary); border-radius: 50%; animation: spin 0.8s linear infinite; margin: 30px auto; }
          @keyframes spin { to { transform: rotate(360deg); } }

          /* ASSET & HISTORY UI FIXES */
          .hist-tabs { display: flex; gap: 10px; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
          .hist-tabs div { padding: 8px 15px; font-weight: 600; font-size: 0.9rem; color: #888; cursor: pointer; border-radius: 20px; transition: 0.2s; }
          .hist-tabs div.active { background: var(--primary); color: white; }

          .asset-card { background: white; border: 1px solid #eee; border-radius: 12px; padding: 15px; margin-bottom: 12px; box-shadow: var(--shadow-sm); }
          .asset-head { font-weight: 700; font-size: 0.95rem; color: var(--text); margin-bottom: 8px; border-bottom: 1px dashed #eee; padding-bottom: 8px; }
          .asset-date { font-size: 0.75rem; color: #888; margin-bottom: 10px; display:block; }
          .acc-box { background: #f9f9f9; padding: 10px; border-radius: 8px; border: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; margin-top: 5px; }
          .acc-val { font-family: var(--code-font); font-size: 0.85rem; color: var(--primary); font-weight: 600; word-break: break-all; }
          .copy-btn-sm { background: white; border: 1px solid #ddd; border-radius: 6px; padding: 4px 8px; font-size: 0.7rem; cursor: pointer; color: #555; }

          .hist-item { background: white; padding: 15px; border-radius: 12px; margin-bottom: 10px; border: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
          .hist-info h4 { margin: 0 0 4px 0; font-size: 0.9rem; color: var(--text); }
          .hist-info p { margin: 0; font-size: 0.75rem; color: #888; }
          .hist-status-badge { font-size: 0.7rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; }
          .badge-pending { background: #FEF2F2; color: #EF4444; }
          .badge-paid { background: #ECFDF5; color: #10B981; }

          .stock-item { background: #fff; border: 1px solid #E5E7EB; padding: 12px; border-radius: 10px; margin-bottom: 8px; display:flex; justify-content:space-between; align-items:center; font-family: var(--code-font); font-size: 0.85rem; box-shadow: var(--shadow-sm); }
          .voc-item { background: #fff; border-left: 4px solid var(--primary); padding: 15px; border-radius: 8px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center; box-shadow: var(--shadow-sm); }

          .bottom-sheet { position: fixed; bottom: 0; left: 0; width: 100%; background: white; border-radius: 20px 20px 0 0; padding: 20px; z-index: 5200; transform: translateY(100%); transition: transform 0.3s; box-shadow: 0 -5px 20px rgba(0,0,0,0.1); }
          .bottom-sheet.active { transform: translateY(0); }
          .sheet-option { padding: 15px; border-bottom: 1px solid #eee; font-size: 1rem; color: var(--text); cursor: pointer; }
      </style>
  </head>
  <body>
      <div id="toastContainer" class="toast-container"></div>

      <nav class="navbar">
          <div class="nav-brand">${DEFAULT_CONFIG.storeName}</div>
      </nav>

      <div id="bannerCarousel" class="banner-container"></div>

      <div class="controls">
          <div class="search-wrapper">
              <span class="search-icon">${ICONS.search}</span>
              <input type="text" id="searchInput" class="search-box" placeholder="Cari produk..." onkeyup="handleSearch(event)">
          </div>
          <div class="filter-btn" onclick="openSheet()">${ICONS.filter}</div>
      </div>

      <div class="cat-scroll" id="catList"></div>

      <div class="container">
          <div id="loading" class="loader"></div>
          <div id="productList" class="grid"></div>
          <div id="noResults" style="display:none; text-align:center; padding:50px; color:#9CA3AF;">Produk tidak ditemukan.</div>
      </div>

      <div class="bottom-nav">
          <div class="nav-item" onclick="openContact()">
              ${ICONS.chat}
              <span>Chat</span>
          </div>
          <div class="nav-item" onclick="openHistory()">
              ${ICONS.history}
              <span>Riwayat</span>
          </div>
          <div class="nav-item" onclick="openAssets()">
              ${ICONS.wallet}
              <span>Aset</span>
          </div>
          <div class="nav-item active" onclick="goToHome()" id="navHome">
              ${ICONS.cart}
              <span>Belanja</span>
          </div>
          <div class="nav-item" onclick="openUserMenu()">
              ${ICONS.user}
              <span>Saya</span>
          </div>
      </div>

      <div id="quickAdminBtn" class="admin-float-btn" onclick="openAdminMenu()">${ICONS.settings}</div>

      <div id="adminMenuPage" class="fs-modal">
          <div class="fs-header">
              <div>Admin Panel</div>
              <button class="fs-back-btn" onclick="closeAdminMenu()">${ICONS.close}</button>
          </div>
          <div class="admin-container">
              <div class="admin-sidebar" id="adminSidebar">
                  <div class="sidebar-item active" onclick="switchAdminTab('prod')" id="sbProd">${ICONS.bag}</div>
                  <div class="sidebar-item" onclick="switchAdminTab('vouc')" id="sbVouc">${ICONS.ticket}</div>
                  <div class="sidebar-item" onclick="switchAdminTab('stats')" id="sbStats">${ICONS.chart}</div>
                  <div class="sidebar-item" onclick="switchAdminTab('conf')" id="sbConf">${ICONS.settings}</div>
                   <div class="sidebar-item" onclick="doLogout()" style="margin-top:auto; color:#EF4444; background: #FEF2F2;">${ICONS.logout}</div>
              </div>
              <div class="admin-content">
                  <div id="adminTabProd">
                      <div class="accordion" id="accCategory">
                          <div class="accordion-header" onclick="toggleAccordion('accCategory')">
                              <span>Kategori</span>
                              ${ICONS.chevronDown}
                          </div>
                          <div class="accordion-content">
                              <div id="confCatList" class="tag-container"></div>
                              <div style="display:flex; gap:8px;">
                                  <input id="newCatInput" class="input-field" placeholder="Kategori Baru">
                                  <button class="btn-primary" onclick="admAddCat()" style="width:auto; margin-bottom:0; padding: 0 15px;">+</button>
                              </div>
                          </div>
                      </div>

                      <button class="btn-primary" onclick="admOpenStockSelector()" style="background:#4B5563; margin-bottom:15px;">${ICONS.eye} Cek & Kelola Stok</button>

                      <div class="admin-card">
                          <div class="admin-card-title">${ICONS.plus} Produk Baru</div>
                          <div class="accordion" id="accAddProd">
                              <div class="accordion-header" onclick="toggleAccordion('accAddProd')">
                                  <span>Buka Form</span>
                                  ${ICONS.chevronDown}
                              </div>
                              <div class="accordion-content">
                                   <div class="form-grid responsive">
                                      <div class="form-group"><label class="form-label">Kode (Unik)</label><input id="nCode" class="input-field" placeholder="Ex: vps1"></div>
                                      <div class="form-group"><label class="form-label">Harga</label><input id="nPrice" type="number" class="input-field" placeholder="0 = Gratis"></div>
                                  </div>
                                  <div class="form-group"><label class="form-label">Nama Produk</label><input id="nName" class="input-field" placeholder="Nama Produk"></div>
                                  <div class="form-grid responsive">
                                      <div class="form-group"><label class="form-label">Gambar URL</label><input id="nImg" class="input-field" placeholder="https://..."></div>
                                      <div class="form-group"><label class="form-label">Kategori</label><select id="nCat" class="input-field"><option value="">Pilih...</option></select></div>
                                  </div>
                                  <div class="form-group"><label class="form-label">Deskripsi</label><textarea id="nDesc" class="input-field" rows="2" placeholder="Singkat..."></textarea></div>
                                  <div class="form-group">
                                      <label class="form-label">Stok Awal (Pisahkan dengan ;)</label>
                                      <textarea id="nStock" class="input-field" rows="3" placeholder="akun1; akun2..."></textarea>
                                  </div>
                                  <button class="btn-primary" onclick="admAdd()">Simpan Produk</button>
                              </div>
                          </div>
                      </div>
                      <div class="accordion" id="accEditProd">
                          <div class="accordion-header" onclick="toggleAccordion('accEditProd')">
                              <span>${ICONS.edit} Edit / Hapus</span>
                              ${ICONS.chevronDown}
                          </div>
                          <div class="accordion-content">
                               <select id="editProdSelect" class="input-field" onchange="loadEditForm()" style="margin-bottom:15px;"></select>
                               <div id="editFormArea" style="display:none; margin-top:10px; border-top:1px solid #E5E7EB; padding-top:15px;">
                                  <div class="form-grid responsive">
                                      <div class="form-group"><label class="form-label">Harga</label><input id="editPrice" type="number" class="input-field"></div>
                                       <div class="form-group"><label class="form-label">Kategori</label><select id="editCat" class="input-field"></select></div>
                                  </div>
                                  <div class="form-group"><label class="form-label">Gambar URL</label><input id="editImg" class="input-field"></div>
                                  <div class="form-group"><label class="form-label">Deskripsi</label><textarea id="editDesc" class="input-field" rows="2"></textarea></div>
                                  <div style="display:flex; gap:10px; margin-top:10px;">
                                      <button class="btn-primary" onclick="admSave()">Update</button>
                                      <button class="btn-danger" onclick="admDelete()">Hapus</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div id="adminTabVouc" style="display:none;">
                      <div class="accordion" id="accAddVoucher">
                          <div class="accordion-header" onclick="toggleAccordion('accAddVoucher')">
                              <span>Buat Voucher</span>
                              ${ICONS.chevronDown}
                          </div>
                          <div class="accordion-content">
                              <div class="form-grid responsive">
                                  <div class="form-group"><label class="form-label">Kode Voucher</label><input id="vCode" class="input-field" placeholder="SALE"></div>
                                  <div class="form-group"><label class="form-label">Nominal Potongan</label><input id="vAmount" type="number" class="input-field" placeholder="1000"></div>
                              </div>
                          <div class="form-group"><label class="form-label">Limit Penggunaan</label><input id="vLimit" type="number" class="input-field" placeholder="100"></div>
                          <div class="form-group"><label class="form-label">Target Produk</label><select id="vTarget" class="input-field"><option value="ALL">Semua</option></select></div>
                          <button class="btn-primary" onclick="admSaveVoucher()">Simpan Voucher</button>
                      </div>
                      <div id="voucherListAdmin" style="margin-top:20px;"></div>
                  </div>
                  <div id="adminTabStats" style="display:none;">
                      <div class="stat-card-grid">
                          <div class="admin-card" style="text-align:center; padding:15px;"><div style="font-size:0.8rem; color:#888;">Hari Ini</div><div id="statDaily" style="font-weight:bold; font-size:1.1rem; color:#2563EB">...</div></div>
                          <div class="admin-card" style="text-align:center; padding:15px;"><div style="font-size:0.8rem; color:#888;">Bulan Ini</div><div id="statMonthly" style="font-weight:bold; font-size:1.1rem; color:#2563EB">...</div></div>
                          <div class="admin-card" style="grid-column: span 2; text-align:center; background:#2563EB; color:white; padding:15px;"><div style="font-size:0.8rem; opacity:0.8;">Total Pendapatan</div><div id="statTotal" style="font-weight:bold; font-size:1.4rem;">...</div></div>
                      </div>
                      <div class="admin-card">
                          <div class="admin-card-title">Riwayat Penjualan</div>
                          <div id="salesHistoryList"></div>
                      </div>
                  </div>
                  <div id="adminTabConf" style="display:none;">
                      <div class="accordion" id="accConfGeneral">
                          <div class="accordion-header" onclick="toggleAccordion('accConfGeneral')">
                              <span>Konfigurasi Umum</span>
                              ${ICONS.chevronDown}
                          </div>
                          <div class="accordion-content">
                              <div class="form-group"><label class="form-label">Logo URL</label><input id="confFavicon" class="input-field"></div>
                              <div class="form-group"><label class="form-label">Banner Images (URL)</label><div style="font-size:0.75rem; color:#aaa; margin-bottom:5px;">Satu URL per baris.</div><textarea id="confBanners" class="input-field" rows="5" placeholder="https://..." style="white-space: pre;"></textarea></div>
                          </div>
                      </div>
                      <div class="accordion" id="accConfOg">
                          <div class="accordion-header" onclick="toggleAccordion('accConfOg')">
                              <span>Tampilan Link Share</span>
                              ${ICONS.chevronDown}
                          </div>
                          <div class="accordion-content">
                              <div class="form-group"><label class="form-label">Gambar OG</label><input id="confOgImage" class="input-field" oninput="previewOgAdmin()"><img id="adminOgPreview" src="" style="max-width:100%; height:120px; object-fit:cover; margin-top:10px; border-radius:8px; display:none; border:1px solid #eee;"></div>
                              <div class="form-group"><label class="form-label">Judul Website</label><input id="confOgTitle" class="input-field"></div>
                          <div class="form-group"><label class="form-label">Deskripsi Website</label><textarea id="confOgDesc" class="input-field" rows="2"></textarea></div>
                      </div>
                      <button class="btn-primary" onclick="admSaveConfig()">Simpan Konfigurasi</button>
                  </div>
              </div>
          </div>
      </div>

      <div id="selectProductModal" class="modal">
          <div class="modal-content">
              <div class="close-icon" onclick="closeModal('selectProductModal')">${ICONS.close}</div>
              <h3 style="margin-top:0;">Pilih Produk</h3>
              <div id="productSelectList" class="product-select-list"></div>
          </div>
      </div>

      <div id="stockDetailModal" class="modal">
          <div class="modal-content" style="max-width:500px;">
              <div class="close-icon" onclick="closeModal('stockDetailModal')">${ICONS.close}</div>
              <h3 style="margin-top:0;">Kelola Stok</h3>
              <div style="font-size:0.85rem; color:var(--text-muted); margin-bottom:15px;">Produk: <span id="stkModalName" style="color:var(--text); font-weight:bold;"></span></div>
              <div id="stockListContainer" class="stock-list"></div>
              <div class="stock-adder-box">
                  <label class="form-label">Tambah Stok Cepat</label>
                  <textarea id="newStockDirect" class="input-field" rows="3" placeholder="Akun1; Akun2..."></textarea>
                  <button class="btn-primary" onclick="admAddStockDirect()" style="margin-bottom:0;">+ Tambah Stok</button>
              </div>
              <div style="margin-top:15px; text-align:right;"><button class="btn-secondary" style="width:auto;" onclick="closeModal('stockDetailModal')">Tutup</button></div>
          </div>
      </div>

      <div id="userMenuPage" class="fs-modal">
          <div class="fs-header"><button class="fs-back-btn" onclick="closeUserMenu()">${ICONS.back}</button><span>Profil Saya</span></div>
          <div class="fs-content">
              <div class="fs-profile-card">
                  <div id="profileAvatar" class="fs-avatar">U</div>
                  <div class="fs-info"><h3 id="profileName">User</h3><p>Member Digital Premium</p></div>
              </div>
              <div class="fs-menu-group">
                  <div class="fs-menu-item" onclick="openInputName()"><div style="display:flex; gap:12px;">${ICONS.edit} Ubah Profil</div><div>${ICONS.next}</div></div>
              </div>
              <div style="text-align:center; margin-top:30px; color:#9CA3AF; font-size:0.8rem; font-weight:bold;">NGANGGURO COMPANY</div>
          </div>
      </div>

      <div id="inputNameModal" class="modal">
          <div class="modal-content" style="text-align:center; max-width:320px;">
              <div style="font-size:3rem; color:var(--primary); margin-bottom:10px;">${ICONS.user}</div>
              <h3>Selamat Datang!</h3>
              <p style="color:var(--text-muted); font-size:0.9rem; margin-bottom:20px;">Lengkapi profil Anda.</p>
              <input type="text" id="inputUsername" class="input-field" placeholder="Nama Panggilan / Username" style="text-align:center; font-weight:bold;">
              <div class="file-upload-wrapper" style="margin-bottom:15px;">
                  <div id="imgPreviewArea" style="margin-bottom:15px; display:none; position:relative;">
                      <img id="previewEl" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border:3px solid var(--primary); box-shadow:0 5px 15px rgba(0,0,0,0.1);">
                      <button onclick="removeProfileImg()" style="background:#EF4444; border:none; width:30px; height:30px; border-radius:50%; position:absolute; bottom:0; left:calc(50% + 20px); color:white; cursor:pointer; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">${ICONS.trash}</button>
                  </div>
                  <label for="inputUserImg" class="btn-secondary" style="display:block; text-align:center; cursor:pointer; background:#F3F4F6; padding:12px; border:1px solid transparent; display:flex; align-items:center; justify-content:center; gap:10px;">${ICONS.camera} <span>Pilih Foto</span></label>
                  <input type="file" id="inputUserImg" accept="image/*" style="display:none;" onchange="previewFile()">
              </div>
              <button class="btn-primary" onclick="saveUsername()">Simpan</button>
          </div>
      </div>
      <div id="historyModal" class="modal">
          <div class="modal-content">
              <div class="close-icon" onclick="closeModal('historyModal')">${ICONS.close}</div><h3 style="margin-top:0;">Riwayat Transaksi</h3>
              <div class="hist-tabs">
                  <div class="active" onclick="filterHist('all')" id="tabAll">Semua</div>
                  <div onclick="filterHist('pending')" id="tabPending">Belum Bayar</div>
                  <div onclick="filterHist('paid')" id="tabPaid">Selesai</div>
              </div>
              <div id="histList" style="min-height:200px; max-height:400px; overflow-y:auto; margin-top:10px;"></div>
          </div>
      </div>
      <div id="myProductsModal" class="modal">
          <div class="modal-content">
              <div class="close-icon" onclick="closeModal('myProductsModal')">${ICONS.close}</div>
              <h3 style="margin-top:0;">Produk Saya</h3>
              <div id="myProdList" style="min-height:300px; max-height:500px; overflow-y:auto; padding-top:10px;"></div>
          </div>
      </div>
      <div id="trxModal" class="modal"><div class="modal-content"><div class="close-icon" onclick="closeModal('trxModal')">${ICONS.close}</div><div id="trxBody"></div></div></div>

      <div id="loginModal" class="modal">
          <div class="modal-content" style="text-align:center;">
              <div class="close-icon" onclick="closeModal('loginModal')">${ICONS.close}</div><h3 style="margin-top:0">Admin Login</h3>
              <p style="font-size:0.85rem; color:var(--text-muted); margin-bottom:20px;">Akses khusus pemilik toko.</p>
              <input type="password" id="adminPass" class="input-field" placeholder="Password Admin">
              <button class="btn-primary" onclick="doLogin()">Masuk</button>
          </div>
      </div>

      <div id="sortSheetBg" class="modal" onclick="closeSheet()"></div>
      <div id="sortSheet" class="bottom-sheet">
          <div class="sheet-option selected" data-sort="newest" onclick="setSort('newest')">Terbaru</div>
          <div class="sheet-option" data-sort="price_low" onclick="setSort('price_low')">Harga Terendah</div>
          <div class="sheet-option" data-sort="price_high" onclick="setSort('price_high')">Harga Tertinggi</div>
      </div>
      <script>
  `;

  const HTML_PART_2 = `
          const ICONS = ${JSON.stringify(ICONS)};
          let allProducts=[],currentCode='',currentOrderId='',currentUser='',currentUserImg='',currentSort='newest',currentCat='Semua',appliedVoucher=null;
          let activeStockCode = '';
          let BANNERS=${JSON.stringify(DEFAULT_CONFIG.banners)},CATEGORIES=${JSON.stringify(DEFAULT_CONFIG.cats)},OG_TITLE="${DEFAULT_CONFIG.ogTitle}",OG_DESC="${DEFAULT_CONFIG.ogDesc}",FAVICON_URL="${DEFAULT_CONFIG.favicon}",OG_IMAGE_URL="${DEFAULT_CONFIG.ogImage}";
          const CONTACT_URL="${DEFAULT_CONFIG.contact}";

          async function init(){checkUser();checkAdminSession();await loadConfig();await loadProducts();checkPendingHistory();initBannerSlider()}
          function checkAdminSession(){
              if(localStorage.getItem('adminKey')) document.getElementById('quickAdminBtn').style.display='flex';
              else document.getElementById('quickAdminBtn').style.display='none';
          }
          async function loadConfig(){try{const r=await fetch('/api/config');const d=await r.json();if(d.banners)BANNERS=d.banners;if(d.cats&&d.cats.length>0)CATEGORIES=d.cats;if(d.favicon)FAVICON_URL=d.favicon;renderCategories()}catch(e){}}

          function initBannerSlider() {
              const c = document.getElementById('bannerCarousel');
              if(BANNERS.length === 0) { c.style.display = 'none'; return; }
              let h = '<div class="banner-slider" id="bannerSlider">';
              let d = '<div class="banner-dots">';
              BANNERS.forEach((b, i) => {
                  h += \`<div class="banner-slide"><img src="\${b}" class="banner-img"></div>\`;
                  d += \`<div class="dot \${i===0?'active':''}" id="dot-\${i}"></div>\`;
              });
              h += '</div>' + d + '</div>';
              c.innerHTML = h;
              const slider = document.getElementById('bannerSlider');
              if(BANNERS.length > 1) {
                  let idx = 0, isTouching = false;
                  slider.addEventListener('scroll', () => {
                      const cur = Math.round(slider.scrollLeft / slider.offsetWidth);
                      document.querySelectorAll('.dot').forEach(e=>e.classList.remove('active'));
                      const activeDot = document.getElementById('dot-'+cur);
                      if(activeDot) activeDot.classList.add('active');
                      idx = cur;
                  });
                  slider.addEventListener('touchstart', () => isTouching = true);
                  slider.addEventListener('touchend', () => setTimeout(() => isTouching = false, 2000));
                  setInterval(() => {
                      if(!isTouching) {
                          idx = (idx + 1) % BANNERS.length;
                          slider.scrollTo({ left: idx * slider.offsetWidth, behavior: 'smooth' });
                      }
                  }, 4000);
              }
          }

          function setActiveNav(id) {
              document.querySelectorAll('.nav-item').forEach(e => e.classList.remove('active'));
              document.getElementById(id).classList.add('active');
          }
          function openContact() { window.open(CONTACT_URL, '_blank'); }

          function openHistory() {
              closeModal('myProductsModal'); closeModal('userMenuPage');
              filterHist('all'); // Default view
              openModal('historyModal');
          }

          function filterHist(type) {
              document.querySelectorAll('.hist-tabs div').forEach(e => e.classList.remove('active'));
              if(type === 'all') document.getElementById('tabAll').classList.add('active');
              if(type === 'pending') document.getElementById('tabPending').classList.add('active');
              if(type === 'paid') document.getElementById('tabPaid').classList.add('active');

              const l = document.getElementById('histList');
              const h = getHistory();
              l.innerHTML = '';

              const filtered = h.filter(i => {
                  if(type === 'all') return true;
                  if(type === 'pending') return i.status === 'PENDING';
                  if(type === 'paid') return i.status === 'PAID' || i.status === 'completed';
                  return true;
              });

              if(filtered.length === 0) {
                  l.innerHTML = '<p style="text-align:center; color:#888; margin-top:30px;">Tidak ada riwayat.</p>';
              } else {
                  filtered.forEach(i => {
                      const badgeClass = i.status === 'PAID' ? 'badge-paid' : 'badge-pending';
                      const statusText = i.status === 'PAID' ? 'Selesai' : 'Belum Bayar';
                      l.innerHTML += \`<div class="hist-item" onclick="showHistoryDetail('\${i.oid}')">
                          <div class="hist-info">
                              <h4>\${i.name}</h4>
                              <p>\${i.date}</p>
                          </div>
                          <div style="text-align:right">
                              <div class="hist-status-badge \${badgeClass}">\${statusText}</div>
                              <div style="font-weight:bold; margin-top:4px; font-size:0.9rem; color:var(--primary)">Rp \${i.price.toLocaleString()}</div>
                          </div>
                      </div>\`;
                  });
              }
          }

          function openAssets() { closeModal('historyModal'); closeModal('userMenuPage'); openMyProductsModal(); }
          function goToHome() {
              closeModal('historyModal'); closeModal('myProductsModal'); closeModal('userMenuPage');
              setActiveNav('navHome');
              window.scrollTo({top:0, behavior:'smooth'});
          }

          function toggleSidebar(){document.getElementById('adminSidebar').classList.toggle('expanded')}
          function switchAdminTab(t){
              document.querySelectorAll('.sidebar-item').forEach(e=>e.classList.remove('active'));
              document.getElementById('sb'+t.charAt(0).toUpperCase()+t.slice(1)).classList.add('active');
              document.querySelectorAll('.admin-content > div').forEach(e=>e.style.display='none');
              if(t==='prod'){ document.getElementById('adminTabProd').style.display='block'; renderAdminOptions(); renderAdminCats(); }
              if(t==='vouc'){ document.getElementById('adminTabVouc').style.display='block'; loadAdminVouchers(); renderVoucherTargets(); }
              if(t==='conf'){ document.getElementById('adminTabConf').style.display='block'; initAdminConfUI(); }
              if(t==='stats'){ document.getElementById('adminTabStats').style.display='block'; loadAdminStats(); }
          }
          function toggleAccordion(id){const el=document.getElementById(id);el.classList.toggle('open')}
          function initAdminConfUI(){document.getElementById('confBanners').value=BANNERS.join('\\n');document.getElementById('confOgTitle').value=OG_TITLE;document.getElementById('confOgDesc').value=OG_DESC;document.getElementById('confFavicon').value=FAVICON_URL;document.getElementById('confOgImage').value=OG_IMAGE_URL;previewOgAdmin();renderAdminCats()}
          function previewOgAdmin(){const v=document.getElementById('confOgImage').value;const i=document.getElementById('adminOgPreview');if(v){i.src=v;i.style.display='block'}else i.style.display='none'}

          function renderAdminCats(){
              const d=document.getElementById('confCatList');
              if(!d) return; d.innerHTML='';
              if(CATEGORIES.length === 0) d.innerHTML = '<span style="color:#9CA3AF; font-size:0.8rem;">Belum ada kategori.</span>';
              else CATEGORIES.forEach((c,i)=>d.innerHTML+=\`<div class="tag">\${c} <span class="tag-del" onclick="admRemCat(\${i})">\${ICONS.trash}</span></div>\`);
          }
          function admAddCat(){ const el = document.getElementById('newCatInput'); const v = el.value.trim(); if(v){ CATEGORIES.push(v); el.value=''; renderAdminCats(); renderAdminOptions(); admSaveConfigSilent(); } }
          function admRemCat(i){ if(confirm("Hapus?")){ CATEGORIES.splice(i,1); renderAdminCats(); renderAdminOptions(); admSaveConfigSilent(); } }
          async function admSaveConfigSilent(){
               const banners = document.getElementById('confBanners').value.split('\\n').map(x=>x.trim()).filter(x=>x);
               const b={banners:banners,cats:CATEGORIES,ogTitle:document.getElementById('confOgTitle').value,ogDesc:document.getElementById('confOgDesc').value,favicon:document.getElementById('confFavicon').value,ogImage:document.getElementById('confOgImage').value};
               await fetch('/api/admin/save-config',{method:'POST',headers:{'Admin-Key':localStorage.getItem('adminKey')},body:JSON.stringify(b)});
          }
          async function admSaveConfig(){
              const banners = document.getElementById('confBanners').value.split('\\n').map(x=>x.trim()).filter(x=>x);
              const b={banners:banners,cats:CATEGORIES,ogTitle:document.getElementById('confOgTitle').value,ogDesc:document.getElementById('confOgDesc').value,favicon:document.getElementById('confFavicon').value,ogImage:document.getElementById('confOgImage').value};
              const r=await fetch('/api/admin/save-config',{method:'POST',headers:{'Admin-Key':localStorage.getItem('adminKey')},body:JSON.stringify(b)});
              if((await r.json()).success){toast("Disimpan");loadConfig();initBannerSlider()}else toast("Gagal",true)
          }
          function closeAdminMenu(){document.getElementById('adminMenuPage').classList.remove('active')}

          function admOpenStockSelector(){const l=document.getElementById('productSelectList');l.innerHTML='';if(allProducts.length===0)l.innerHTML='<p style="text-align:center">Kosong</p>';else allProducts.forEach(p=>{l.innerHTML+=\`<div class="product-select-item" onclick="admFetchStock('\${p.code}', '\${p.name}')"><span class="prod-name-select">\${p.name}</span><span class="prod-code-select">\${p.code}</span></div>\`});openModal('selectProductModal')}
          async function admFetchStock(c, name){ activeStockCode = c; closeModal('selectProductModal'); document.getElementById('stkModalName').innerText = name || c; document.getElementById('stockListContainer').innerHTML='<div class="loader"></div>'; openModal('stockDetailModal'); try{ const r=await fetch('/api/admin/get-stock?code='+c,{headers:{'Admin-Key':localStorage.getItem('adminKey')}}); const d=await r.json(); renderStockList(d.stock); }catch{document.getElementById('stockListContainer').innerHTML='Error'} }
          function renderStockList(stockArr) { const l=document.getElementById('stockListContainer'); l.innerHTML=''; if(stockArr&&stockArr.length>0) { stockArr.forEach((item, index)=>{ const safeItem = item.replace(/'/g, "\\'"); l.innerHTML+=\`<div class="stock-item"><span>\${item}</span><div style="display:flex;gap:10px;"><div style="cursor:pointer;color:var(--primary)" onclick="copyText('\${safeItem}')">\${ICONS.copy}</div><div class="stock-del-btn" onclick="admDelStockDirect('\${index}')">\${ICONS.trash}</div></div></div>\`; }); } else { l.innerHTML='<p style="text-align:center; color:var(--text-muted)">Stok Kosong</p>'; } }
          async function admAddStockDirect() { const data = document.getElementById('newStockDirect').value; if(!data) return toast("Isi data", true); const btn = document.querySelector('.stock-adder-box button'); const oldTxt = btn.innerText; btn.innerText = '...'; btn.disabled = true; try { const r = await fetch('/api/admin/stock-action', { method: 'POST', headers: {'Admin-Key':localStorage.getItem('adminKey')}, body: JSON.stringify({ code: activeStockCode, action: 'add', data: data }) }); const res = await r.json(); if(res.success) { document.getElementById('newStockDirect').value = ''; renderStockList(res.newStock); toast("Sukses"); loadProducts(); } else { toast("Gagal", true); } } catch(e) { toast("Error", true); } btn.innerText = oldTxt; btn.disabled = false; }
          async function admDelStockDirect(index) { if(!confirm("Hapus?")) return; try { const r = await fetch('/api/admin/stock-action', { method: 'POST', headers: {'Admin-Key':localStorage.getItem('adminKey')}, body: JSON.stringify({ code: activeStockCode, action: 'delete', index: index }) }); const res = await r.json(); if(res.success) { renderStockList(res.newStock); toast("Dihapus"); loadProducts(); } } catch(e) { toast("Error", true); } }

          async function loadAdminStats(){const l=document.getElementById('salesHistoryList');l.innerHTML='<div class="loader"></div>';try{const r=await fetch('/api/admin/stats',{headers:{'Admin-Key':localStorage.getItem('adminKey')}});const d=await r.json();if(d.success){document.getElementById('statDaily').innerText='Rp '+(d.daily||0).toLocaleString('id-ID');document.getElementById('statMonthly').innerText='Rp '+(d.monthly||0).toLocaleString('id-ID');document.getElementById('statTotal').innerText='Rp '+(d.total||0).toLocaleString('id-ID');l.innerHTML='';if(d.history&&d.history.length>0)d.history.forEach(s=>{l.innerHTML+=\`<div class="stock-item"><div><span style="font-weight:bold">\${s.name}</span><br><span style="font-size:0.75rem;color:#888">\${new Date(s.date).toLocaleString()}</span></div><div style="font-weight:bold;color:#2563EB">Rp \${(s.price||0).toLocaleString('id-ID')}</div></div>\`});else l.innerHTML='<p style="text-align:center; color:var(--text-muted)">Belum ada data</p>'}}catch{l.innerHTML='Error'}}
          function renderVoucherTargets(){const s=document.getElementById('vTarget');s.innerHTML='<option value="ALL">Semua Produk</option>';allProducts.forEach(p=>s.innerHTML+=\`<option value="\${p.code}">\${p.name}</option>\`)}
          async function loadAdminVouchers(){const r=await fetch('/api/admin/vouchers',{headers:{'Admin-Key':localStorage.getItem('adminKey')}});const d=await r.json();const l=document.getElementById('voucherListAdmin');l.innerHTML='';if(d.vouchers.length===0){l.innerHTML='<p style="color:#666; text-align:center">Belum ada voucher</p>';return}d.vouchers.forEach(v=>{const tn=v.validFor==='ALL'?'Semua':(allProducts.find(x=>x.code===v.validFor)?.name||v.validFor);l.innerHTML+=\`<div class="voc-item"><div><div style="color:var(--primary);font-weight:bold;font-size:1rem;">\${v.code}</div><div style="font-size:0.85rem; color:var(--text-muted)">Potongan: Rp \${v.amount.toLocaleString()}</div><div style="font-size:0.75rem;color:var(--warning)">Target: \${tn} | Terpakai: \${v.limit>0?(v.used||0)+'/'+v.limit:'Unlimited'}</div></div><button class="btn-danger" style="width:auto; padding:8px 12px; margin:0;" onclick="admDelVoucher('\${v.code}')">${ICONS.trash}</button></div>\`})}
          async function admSaveVoucher(){const c=document.getElementById('vCode').value.trim().toUpperCase(),a=parseInt(document.getElementById('vAmount').value),t=document.getElementById('vTarget').value,l=parseInt(document.getElementById('vLimit').value)||0;if(!c||!a)return toast("Lengkapi data",true);await fetch('/api/admin/save-voucher',{method:'POST',headers:{'Admin-Key':localStorage.getItem('adminKey')},body:JSON.stringify({code:c,amount:a,validFor:t,limit:l})});toast("Disimpan");loadAdminVouchers()}
          async function admDelVoucher(c){if(!confirm("Hapus?"))return;await fetch('/api/admin/del-voucher',{method:'POST',headers:{'Admin-Key':localStorage.getItem('adminKey')},body:JSON.stringify({code:c})});toast("Dihapus");loadAdminVouchers()}
          function renderCategories(){const l=document.getElementById('catList');l.innerHTML='';CATEGORIES.forEach(c=>{l.innerHTML+=\`<div class="cat-pill \${c===currentCat?'active':''}" onclick="setCategory('\${c}')">\${c}</div>\`})}
          function setCategory(c){currentCat=c;renderCategories();applyFilter()}
          function checkUser(){const u=localStorage.getItem('storeUser'),i=localStorage.getItem('storeUserImg');if(!u)document.getElementById('inputNameModal').classList.add('active');else{currentUser=u;currentUserImg=i;updateProfileUI()}}
          function updateProfileUI(){if(currentUser){document.getElementById('profileName').innerText=currentUser;const a=document.getElementById('profileAvatar');if(currentUserImg){a.innerText='';a.style.backgroundImage=\`url('\${currentUserImg}')\`}else{a.style.backgroundImage='none';a.innerText=currentUser.charAt(0).toUpperCase()}} checkPendingHistory()}
          function openUserMenu(){updateProfileUI();document.getElementById('userMenuPage').classList.add('active')}
          function closeUserMenu(){document.getElementById('userMenuPage').classList.remove('active')}
          let tempBase64Img="";function previewFile(){const f=document.getElementById('inputUserImg').files[0];if(!f)return;const r=new FileReader();r.onloadend=function(){const i=new Image();i.onload=function(){const c=document.createElement('canvas'),s=150/i.width;c.width=150;c.height=i.height*s;const x=c.getContext("2d");x.drawImage(i,0,0,c.width,c.height);tempBase64Img=c.toDataURL("image/jpeg",0.7);document.getElementById('imgPreviewArea').style.display='block';document.getElementById('previewEl').src=tempBase64Img};i.src=r.result};r.readAsDataURL(f)}
          function removeProfileImg(){tempBase64Img="";document.getElementById('inputUserImg').value="";document.getElementById('imgPreviewArea').style.display='none';localStorage.removeItem('storeUserImg');currentUserImg="";updateProfileUI()}
          function saveUsername(){const v=document.getElementById('inputUsername').value.trim();if(!v)return toast("Wajib diisi",true);localStorage.setItem('storeUser',v);if(tempBase64Img){localStorage.setItem('storeUserImg',tempBase64Img);currentUserImg=tempBase64Img}currentUser=v;closeModal('inputNameModal');updateProfileUI()}
          function openInputName(){document.getElementById('inputUsername').value=currentUser||'';if(currentUserImg){document.getElementById('imgPreviewArea').style.display='block';document.getElementById('previewEl').src=currentUserImg}else document.getElementById('imgPreviewArea').style.display='none';openModal('inputNameModal')}
          function toast(m,e=false){const c=document.getElementById('toastContainer'),l=document.createElement('div');l.className='toast'+(e?' error':' success');l.innerHTML=(e?ICONS.close:ICONS.check)+'<span>'+m+'</span>';c.appendChild(l);setTimeout(()=>{l.style.animation='toast-out 0.5s forwards';l.addEventListener('animationend',()=>l.remove())},3000)}
          function openModal(id){document.getElementById(id).classList.add('active')}
          function closeModal(id){document.getElementById(id).classList.remove('active')}
          function openSheet(){document.getElementById('sortSheetBg').classList.add('active');document.getElementById('sortSheet').classList.add('active')}
          function closeSheet(){document.getElementById('sortSheetBg').classList.remove('active');document.getElementById('sortSheet').classList.remove('active')}
          function setSort(t){currentSort=t;document.querySelectorAll('.sheet-option').forEach(e=>e.classList.remove('selected'));closeSheet();applyFilter()}
          async function loadProducts(){try{const r=await fetch('/api/products');const d=await r.json();allProducts=d.products;applyFilter();document.getElementById('loading').style.display='none'}catch{}}
          function applyFilter(){const q=document.getElementById('searchInput').value.toLowerCase();let f=allProducts.filter(p=>(p.name.toLowerCase().includes(q))&&(currentCat==='Semua'||p.category===currentCat));if(currentSort==='price_low')f.sort((a,b)=>a.price-b.price);else if(currentSort==='price_high')f.sort((a,b)=>b.price-a.price);else f.reverse();const l=document.getElementById('productList');l.innerHTML='';if(f.length===0)document.getElementById('noResults').style.display='block';else{document.getElementById('noResults').style.display='none';f.forEach(p=>{const btn=p.stock>0?'BELI':'HABIS',cl=p.stock>0?'active':'';l.innerHTML+=\`<div class="card" onclick="openBuy('\${p.code}')"><div class="prod-img-container">\${p.stock<5&&p.stock>0?'<div class="badge-overlay"><span class="lbl lbl-stock">Sisa '+p.stock+'</span></div>':''}<img src="\${p.img||FAVICON_URL}" class="prod-img"></div><div class="card-content"><h4>\${p.name}</h4><div class="stock">Stok: \${p.stock}</div><div class="price">\${p.price===0?'GRATIS':'Rp '+p.price.toLocaleString('id-ID')}</div><button class="btn-mini \${cl}">\${btn}</button></div></div>\`})}}
          function getHistory(){return JSON.parse(localStorage.getItem('myHistory')||'[]')}
          function saveHistoryItem(i){let h=getHistory();h.unshift(i);localStorage.setItem('myHistory',JSON.stringify(h));checkPendingHistory()}
          function updateHistoryStatus(o,s,c=[]){let h=getHistory(),i=h.findIndex(x=>x.oid===o);if(i>=0){h[i].status=s;if(c&&c.length>0)h[i].content=c;localStorage.setItem('myHistory',JSON.stringify(h))}checkPendingHistory()}
          function checkPendingHistory(){const h=getHistory(),p=h.filter(x=>x.status==='PENDING').length;}
          function openBuy(c){currentCode=c;appliedVoucher=null;const p=allProducts.find(x=>x.code===c);if(!p||p.stock<1)return toast("Stok Habis",true);const html=\`<div id="mStep1"><h3 style="text-align:center;margin-top:0">\${p.name}</h3>\${p.desc?'<div class="desc-text">'+p.desc+'</div>':''}<div class="qty-control"><button class="qty-btn" onclick="changeQty(-1)">-</button><input id="mQty" value="1" readonly class="qty-val"><button class="qty-btn" onclick="changeQty(1)">+</button></div><div class="voucher-input-group"><input id="inputVoucher" class="input-field" placeholder="Kode Voucher"><button class="btn-secondary" onclick="applyVoucher()">Pakai</button></div><div id="voucherMsg" class="voucher-status"></div><div class="checkout-line"><span>Harga:</span><span>Rp \${p.price.toLocaleString('id-ID')}</span></div><div class="checkout-line" id="discountRow" style="display:none;color:var(--success)"><span>Diskon:</span><span id="discountVal">-Rp 0</span></div><div class="checkout-total"><span>Total:</span><span id="mTotal">\${p.price===0?'GRATIS':'Rp '+p.price.toLocaleString('id-ID')}</span></div><button class="btn-primary" style="margin-top:15px" onclick="processBuy()">Lanjut Bayar</button></div>\`;document.getElementById('trxBody').innerHTML=html;openModal('trxModal')}
          function changeQty(d){const e=document.getElementById('mQty');let v=parseInt(e.value)+d,p=allProducts.find(x=>x.code===currentCode);if(v<1)v=1;if(v>p.stock)v=p.stock;e.value=v;updateTotal()}
          async function applyVoucher(){const c=document.getElementById('inputVoucher').value.trim().toUpperCase(),m=document.getElementById('voucherMsg');if(!c)return;m.style.display='block';m.innerText='...';const r=await fetch('/api/check-voucher',{method:'POST',body:JSON.stringify({code:c,productCode:currentCode})}),d=await r.json();if(d.valid){appliedVoucher={code:c,amount:d.amount};m.className='voucher-status success';m.innerText='Hemat Rp '+d.amount.toLocaleString();updateTotal()}else{appliedVoucher=null;m.className='voucher-status error';m.innerText=d.message;updateTotal()}}
          function updateTotal(){const p=allProducts.find(x=>x.code===currentCode),q=parseInt(document.getElementById('mQty').value);let s=p.price*q,d=0;if(appliedVoucher)d=Math.min(appliedVoucher.amount,s);let f=s-d;document.getElementById('mTotal').innerText=f===0?'GRATIS':'Rp '+f.toLocaleString('id-ID');if(d>0){document.getElementById('discountRow').style.display='flex';document.getElementById('discountVal').innerText='-Rp '+d.toLocaleString('id-ID')}else document.getElementById('discountRow').style.display='none'}
          async function processBuy(){const q=parseInt(document.getElementById('mQty').value),v=appliedVoucher?appliedVoucher.code:null;document.getElementById('mStep1').innerHTML='<div class="loader"></div><p style="text-align:center">Memproses...</p>';const r=await fetch('/api/buy',{method:'POST',body:JSON.stringify({code:currentCode,qty:q,voucherCode:v})}),d=await r.json();if(!d.success){closeModal('trxModal');return toast(d.message||"Gagal",true)}const pn=allProducts.find(x=>x.code===currentCode)?.name||currentCode;if(d.isFree){saveHistoryItem({oid:'FREE-'+Date.now(),name:pn,date:new Date().toLocaleString(),status:'PAID',content:d.accounts,price:0});showSuccess(d.accounts,true)}else{currentOrderId=d.orderId;saveHistoryItem({oid:currentOrderId,name:pn,date:new Date().toLocaleString(),status:'PENDING',content:[],price:d.amount,qr:d.qrString});showPaymentUI(d.qrString,d.amount)}}
          function showPaymentUI(q,a){const u=\`https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=\${encodeURIComponent(q)}\`,h=\`<div style="text-align:center"><h3 style="margin-top:0; color:var(--text)">Scan QRIS</h3><div style="background:white;padding:10px;border-radius:10px;display:inline-block;margin-bottom:15px;box-shadow:var(--shadow-md)"><img src="\${u}" style="width:200px;height:200px"></div><p style="font-size:1.3rem;font-weight:bold;color:var(--primary)">Rp \${a.toLocaleString('id-ID')}</p><p style="font-size:0.85rem;color:var(--text-muted)">ID: \${currentOrderId}</p><button id="btnCheckStatus" class="btn-primary" onclick="checkStatus()">Cek Status</button><div style="margin-top:10px;font-size:0.8rem;color:var(--text-muted)">Klik tombol cek status setelah transfer</div></div>\`;document.getElementById('trxBody').innerHTML=h}
          async function checkStatus(){const b=document.getElementById('btnCheckStatus');if(b){b.disabled=true;b.innerText='Memproses...'};const r=await fetch('/api/check-status?oid='+currentOrderId),d=await r.json();if(d.status==='PAID'){const c=await fetch('/api/claim',{method:'POST',body:JSON.stringify({oid:currentOrderId})}),res=await c.json();if(res.success){updateHistoryStatus(currentOrderId,'PAID',res.accounts);showSuccess(res.accounts,true)}else{if(b){b.disabled=false;b.innerText='Cek Status'};toast("Gagal Claim",true)}}else{if(b){b.disabled=false;b.innerText='Cek Status'};toast("Belum dibayar",true)}}
          function showSuccess(a,m=false){const h=\`<div style="text-align:center"><div style="font-size:60px;color:var(--success)">\${ICONS.check}</div><h2 style="color:var(--text)">Berhasil!</h2><div class="acc-list-container" style="max-height:250px;overflow-y:auto;text-align:left">\${a.map(x=>\`<div class="acc-card"><span class="acc-text">\${x}</span><div class="acc-copy-btn" onclick="copyText('\${x}')">\${ICONS.copy}</div></div>\`).join('')}</div><button class="btn-primary" style="margin-top:20px" onclick="closeModal('trxModal');loadProducts()">Tutup</button></div>\`;document.getElementById('trxBody').innerHTML=h;if(!m)openModal('trxModal')}
          function copyText(t){navigator.clipboard.writeText(t).then(()=>toast("Disalin"))}
          function openAdminMenu(){document.getElementById('adminMenuPage').classList.add('active');renderAdminOptions();populateSelects();switchAdminTab('prod')}
          function renderAdminOptions(){const h='<option value="">Pilih Kategori</option>'+CATEGORIES.map(c=>\`<option value="\${c}">\${c}</option>\`).join('');document.getElementById('nCat').innerHTML=h;document.getElementById('editCat').innerHTML=h}
          function populateSelects(){const s=document.getElementById('editProdSelect');s.innerHTML='<option>Pilih Produk</option>';allProducts.forEach(p=>s.innerHTML+=\`<option value="\${p.code}">\${p.name}</option>\`)}
          function loadEditForm(){const c=document.getElementById('editProdSelect').value,p=allProducts.find(x=>x.code===c);if(p){document.getElementById('editFormArea').style.display='block';document.getElementById('editPrice').value=p.price;document.getElementById('editImg').value=p.img||'';document.getElementById('editCat').value=p.category||'';document.getElementById('editDesc').value=p.desc||''}}
          async function admAdd(){const b={code:document.getElementById('nCode').value,name:document.getElementById('nName').value,price:document.getElementById('nPrice').value,img:document.getElementById('nImg').value,category:document.getElementById('nCat').value,desc:document.getElementById('nDesc').value,stockData:document.getElementById('nStock').value};await fetch('/api/admin/add-product',{method:'POST',headers:{'Admin-Key':localStorage.getItem('adminKey')},body:JSON.stringify(b)});toast("Disimpan");document.getElementById('nStock').value='';loadProducts()}
          async function admSave(){const b={code:document.getElementById('editProdSelect').value,price:document.getElementById('editPrice').value,img:document.getElementById('editImg').value,category:document.getElementById('editCat').value,desc:document.getElementById('editDesc').value,stockData:null};await fetch('/api/admin/edit-product',{method:'POST',headers:{'Admin-Key':localStorage.getItem('adminKey')},body:JSON.stringify(b)});toast("Diupdate");loadProducts()}
          async function admDelete(){if(!confirm("Yakin?"))return;await fetch('/api/admin/delete-product',{method:'POST',headers:{'Admin-Key':localStorage.getItem('adminKey')},body:JSON.stringify({code:document.getElementById('editProdSelect').value})});toast("Dihapus");loadProducts();populateSelects();document.getElementById('editFormArea').style.display='none'}
          function openMyProductsModal(){
              const l = document.getElementById('myProdList');
              const h = getHistory();
              l.innerHTML = '';
              let groups = {};
              h.forEach(item => {
                  if (item.status && (item.status === 'PAID' || item.status === 'SUCCESS' || item.status === 'completed')) {
                      const key = item.oid; // Group by Transaction ID
                      if(!groups[key]) groups[key] = { name: item.name, date: item.date, items: [] };
                      if (Array.isArray(item.content)) groups[key].items.push(...item.content);
                      else if (typeof item.content === 'string' && item.content.trim() !== '') groups[key].items.push(item.content);
                  }
              });

              const keys = Object.keys(groups);
              if (keys.length === 0) {
                  l.innerHTML = '<div style="text-align:center;padding:40px;color:#9CA3AF;display:flex;flex-direction:column;align-items:center;gap:10px;">' + ICONS.wallet + '<span>Belum ada aset.</span></div>';
              } else {
                  keys.forEach(k => {
                      const g = groups[k];
                      let itemsHtml = '';
                      g.items.forEach(acc => {
                          let cleanAcc = acc.replace(/<br>/g, "\\n");
                          itemsHtml += \`<div class="acc-box"><span class="acc-val">\${cleanAcc}</span><div class="copy-btn-sm" onclick="copyText('\${cleanAcc}')">Salin</div></div>\`;
                      });

                      l.innerHTML += \`<div class="asset-card">
                          <div class="asset-head">\${g.name}</div>
                          <span class="asset-date">\${g.date}</span>
                          \${itemsHtml}
                      </div>\`;
                  });
              }
              openModal('myProductsModal');
          }
          function handleSearch(e){const v=document.getElementById('searchInput').value;if((e.key==='Enter'||e.keyCode===13)&&v.toLowerCase()==='minkey'){document.getElementById('searchInput').value='';applyFilter();openModal('loginModal');return}applyFilter()}

          async function doLogin(){
              const p=document.getElementById('adminPass').value;
              const r=await fetch('/api/admin/login',{method:'POST',body:JSON.stringify({password:p})});
              const d=await r.json();
              if(d.success){
                  localStorage.setItem('adminKey',p); // USING LOCAL STORAGE
                  closeModal('loginModal');
                  toast("Login Sukses");
                  openAdminMenu();
                  checkAdminSession();
              }else toast("Salah",true)
          }

          function doLogout() {
              localStorage.removeItem('adminKey');
              closeAdminMenu();
              checkAdminSession();
              toast("Logged Out");
          }

          init();
  `;

  // --- BACKEND CLOUDFLARE WORKER ---
  export default {
    async fetch(request, env) {
      if (!env.PREMIUM_DB) return new Response("Error: DATABASE KV NOT CONNECTED", { status: 500 });

      const url = new URL(request.url);
      const corsHeaders = { "Content-Type": "application/json", "Access-Control-Allow-Origin": "*" };

      if (url.pathname === "/") {
          const conf = await env.PREMIUM_DB.get("CONFIG_STORE", { type: "json" }) || {};
          let finalHtml = HTML_PART_1
              .replace(/{{STORE_FAVICON}}/g, conf.favicon || DEFAULT_CONFIG.favicon)
              .replace(/{{OG_IMAGE}}/g, conf.ogImage || DEFAULT_CONFIG.ogImage)
              .replace(/{{OG_TITLE}}/g, conf.ogTitle || DEFAULT_CONFIG.ogTitle)
              .replace(/{{OG_DESC}}/g, conf.ogDesc || DEFAULT_CONFIG.ogDesc)
              + HTML_PART_2 + `</script></body></html>`;
          return new Response(finalHtml, { headers: { "Content-Type": "text/html" } });
      }

      if (url.pathname === "/api/config") {
          const conf = await env.PREMIUM_DB.get("CONFIG_STORE", { type: "json" }) || {};
          return new Response(JSON.stringify(Object.assign({}, DEFAULT_CONFIG, conf)), { headers: corsHeaders });
      }

      if (url.pathname === "/api/products") {
          let list = await env.PREMIUM_DB.get("LIST_PRODUCTS", { type: "json" }) || [];
          let products = [];
          for (const code of list) {
              const prod = await env.PREMIUM_DB.get(`PROD_${code}`, { type: "json" });
              if (!prod) continue;
              const stock = await env.PREMIUM_DB.get(`STOCK_${code}`, { type: "json" }) || [];
              const img = await env.PREMIUM_DB.get(`IMG_${code}`);
              products.push({ code: prod.code, name: prod.name, price: parseInt(prod.price), stock: stock.length, img: img, category: prod.category || '', desc: prod.desc || '' });
          }
          return new Response(JSON.stringify({ products }), { headers: corsHeaders });
      }

      if (url.pathname === "/api/check-voucher" && request.method === "POST") {
          const { code, productCode } = await request.json();
          const voucher = await env.PREMIUM_DB.get(`VOUCHER_${code}`, { type: "json" });
          if (!voucher) return new Response(JSON.stringify({ valid: false, message: "Tidak valid" }), { headers: corsHeaders });
          if (voucher.limit && voucher.limit > 0 && (voucher.used || 0) >= voucher.limit) return new Response(JSON.stringify({ valid: false, message: "Habis" }), { headers: corsHeaders });
          if (voucher.validFor !== "ALL" && voucher.validFor !== productCode) return new Response(JSON.stringify({ valid: false, message: "Tidak berlaku produk ini" }), { headers: corsHeaders });
          return new Response(JSON.stringify({ valid: true, amount: voucher.amount }), { headers: corsHeaders });
      }

      if (url.pathname === "/api/buy" && request.method === "POST") {
          const { code, qty, voucherCode } = await request.json();
          const prod = await env.PREMIUM_DB.get(`PROD_${code}`, { type: "json" });
          let stock = await env.PREMIUM_DB.get(`STOCK_${code}`, { type: "json" }) || [];

          const reqQty = parseInt(qty);
          if (isNaN(reqQty) || reqQty < 1) return new Response(JSON.stringify({ success: false, message: "Jumlah tidak valid" }), { headers: corsHeaders });
          if (!prod || stock.length < reqQty) return new Response(JSON.stringify({ success: false, message: "Stok kurang" }), { headers: corsHeaders });

          let amount = parseInt(prod.price) * reqQty;
          if (voucherCode) {
              const v = await env.PREMIUM_DB.get(`VOUCHER_${voucherCode}`, { type: "json" });
              if (v && (v.validFor === "ALL" || v.validFor === code) && (!v.limit || v.limit === 0 || (v.used || 0) < v.limit)) {
                  amount = Math.max(0, amount - v.amount);
              }
          }

          if (amount === 0) {
              const accounts = []; for(let i=0; i<reqQty; i++) accounts.push(stock.shift());
              await env.PREMIUM_DB.put(`STOCK_${code}`, JSON.stringify(stock));
              if (voucherCode) {
                  const v = await env.PREMIUM_DB.get(`VOUCHER_${voucherCode}`, { type: "json" });
                  if(v) { v.used = (v.used || 0) + 1; await env.PREMIUM_DB.put(`VOUCHER_${voucherCode}`, JSON.stringify(v)); }
              }
              await recordSale(env, prod.name, 0, accounts);
              return new Response(JSON.stringify({ success: true, isFree: true, accounts }), { headers: corsHeaders });
          }

          const orderId = `INV${Date.now()}`;
          const res = await createPakasirTrx(amount, orderId, env);

          if (res.success && res.data.payment) {
              await env.PREMIUM_DB.put(`ORDER_${orderId}`, JSON.stringify({ code, qty: reqQty, status: 'PENDING', voucherCode, amount }), { expirationTtl: 3600 });
              return new Response(JSON.stringify({ success: true, isFree: false, amount, qrString: res.data.payment.payment_number, orderId: orderId }), { headers: corsHeaders });
          }
          return new Response(JSON.stringify({ success: false, message: "Gateway Error" }), { headers: corsHeaders });
      }

      if (url.pathname === "/api/check-status") {
          const oid = new URL(request.url).searchParams.get("oid");
          const orderRaw = await env.PREMIUM_DB.get(`ORDER_${oid}`);
          if(!orderRaw) return new Response(JSON.stringify({ status: 'PENDING' }), { headers: corsHeaders });

          const order = JSON.parse(orderRaw);
          const res = await checkPakasirStatus(oid, order.amount, env);
          const status = (res.success && res.data.transaction && res.data.transaction.status === 'completed') ? 'PAID' : 'PENDING';
          return new Response(JSON.stringify({ status }), { headers: corsHeaders });
      }

      if (url.pathname === "/api/claim" && request.method === "POST") {
          const { oid } = await request.json();
          const orderRaw = await env.PREMIUM_DB.get(`ORDER_${oid}`);
          if (!orderRaw || orderRaw === "CLAIMED") return new Response(JSON.stringify({ success: false }), { headers: corsHeaders });

          const order = JSON.parse(orderRaw);
          const res = await checkPakasirStatus(oid, order.amount, env);

          if (!res.success || !res.data.transaction || res.data.transaction.status !== 'completed') {
               return new Response(JSON.stringify({ success: false }), { headers: corsHeaders });
          }

          await env.PREMIUM_DB.put(`ORDER_${oid}`, "CLAIMED");

          const prod = await env.PREMIUM_DB.get(`PROD_${order.code}`, { type: "json" });
          let stock = await env.PREMIUM_DB.get(`STOCK_${order.code}`, { type: "json" }) || [];

          const qtyToClaim = parseInt(order.qty);
          const accs = [];
          for(let i=0; i<qtyToClaim; i++) if(stock.length>0) accs.push(stock.shift());

          await env.PREMIUM_DB.put(`STOCK_${order.code}`, JSON.stringify(stock));
          if (order.voucherCode) {
              const v = await env.PREMIUM_DB.get(`VOUCHER_${order.voucherCode}`, { type: "json" });
              if(v) { v.used = (v.used || 0) + 1; await env.PREMIUM_DB.put(`VOUCHER_${order.voucherCode}`, JSON.stringify(v)); }
          }
          await recordSale(env, prod ? prod.name : order.code, order.amount, accs);

          return new Response(JSON.stringify({ success: true, accounts: accs }), { headers: corsHeaders });
      }

      if (url.pathname.startsWith("/api/admin")) {
          const body = await request.json().catch(() => ({}));
          if (url.pathname === "/api/admin/login") return new Response(JSON.stringify({ success: body.password === env.ADMIN_PASSWORD }), { headers: corsHeaders });
          if (request.headers.get("Admin-Key") !== env.ADMIN_PASSWORD) return new Response(JSON.stringify({ success: false, message: "Unauthorized" }), { headers: corsHeaders, status: 401 });

          if (url.pathname === "/api/admin/stock-action") {
              const { code, action, data, index } = body;
              let stock = await env.PREMIUM_DB.get(`STOCK_${code}`, { type: "json" }) || [];
              if (action === 'add') {
                  const newItems = data.split(';').map(i => i.trim()).filter(i => i !== '');
                  stock.push(...newItems);
              } else if (action === 'delete') {
                  if(index >= 0 && index < stock.length) stock.splice(index, 1);
              }
              await env.PREMIUM_DB.put(`STOCK_${code}`, JSON.stringify(stock));
              return new Response(JSON.stringify({ success: true, newStock: stock }), { headers: corsHeaders });
          }

          if (url.pathname === "/api/admin/stats") {
              const sales = await env.PREMIUM_DB.get("ADMIN_SALES", { type: "json" }) || [];
              const now = new Date().toISOString();
              let daily = 0, monthly = 0, total = 0;
              sales.forEach(s => {
                  total += (s.price||0);
                  if (s.date.startsWith(now.split('T')[0])) daily += (s.price||0);
                  if (s.date.startsWith(now.slice(0, 7))) monthly += (s.price||0);
              });
              return new Response(JSON.stringify({ success: true, daily, monthly, total, history: sales.slice(0, 50) }), { headers: corsHeaders });
          }
          if (url.pathname === "/api/admin/get-stock") {
              const code = new URL(request.url).searchParams.get("code");
              const stock = await env.PREMIUM_DB.get(`STOCK_${code}`, { type: "json" }) || [];
              return new Response(JSON.stringify({ stock }), { headers: corsHeaders });
          }
          if (url.pathname === "/api/admin/add-product") {
              const c = body.code.replace(/\s/g, "").toLowerCase();
              await env.PREMIUM_DB.put(`PROD_${c}`, JSON.stringify({ code: c, name: body.name, price: body.price, category: body.category, desc: body.desc }));
              if(body.img) await env.PREMIUM_DB.put(`IMG_${c}`, body.img);
              if(body.stockData) await env.PREMIUM_DB.put(`STOCK_${c}`, JSON.stringify(body.stockData.split(";").map(i=>i.trim()).filter(i=>i!=="")));
              let list = await env.PREMIUM_DB.get("LIST_PRODUCTS", { type: "json" }) || [];
              if (!list.includes(c)) { list.push(c); await env.PREMIUM_DB.put("LIST_PRODUCTS", JSON.stringify(list)); }
              return new Response(JSON.stringify({ success: true }), { headers: corsHeaders });
          }
          if (url.pathname === "/api/admin/edit-product") {
              let p = await env.PREMIUM_DB.get(`PROD_${body.code}`, { type: "json" });
              if(!p) return new Response(JSON.stringify({ success: false }), { headers: corsHeaders });
              if(body.price) p.price = parseInt(body.price);
              if(body.category!==undefined) p.category=body.category;
              if(body.desc!==undefined) p.desc=body.desc;
              await env.PREMIUM_DB.put(`PROD_${body.code}`, JSON.stringify(p));
              if(body.img) await env.PREMIUM_DB.put(`IMG_${body.code}`, body.img);
              if(body.stockData) {
                  let s = await env.PREMIUM_DB.get(`STOCK_${body.code}`, { type: "json" }) || [];
                  s.push(...body.stockData.split(";").map(i=>i.trim()).filter(i=>i!==""));
                  await env.PREMIUM_DB.put(`STOCK_${body.code}`, JSON.stringify(s));
              }
              return new Response(JSON.stringify({ success: true }), { headers: corsHeaders });
          }
          if (url.pathname === "/api/admin/delete-product") {
              await env.PREMIUM_DB.delete(`PROD_${body.code}`); await env.PREMIUM_DB.delete(`STOCK_${body.code}`); await env.PREMIUM_DB.delete(`IMG_${body.code}`);
              let list = await env.PREMIUM_DB.get("LIST_PRODUCTS", { type: "json" }) || [];
              await env.PREMIUM_DB.put("LIST_PRODUCTS", JSON.stringify(list.filter(c => c !== body.code)));
              return new Response(JSON.stringify({ success: true }), { headers: corsHeaders });
          }
          if (url.pathname === "/api/admin/save-voucher") {
              const { code, amount, validFor, limit } = body;
              const ex = await env.PREMIUM_DB.get(`VOUCHER_${code}`, { type: "json" });
              await env.PREMIUM_DB.put(`VOUCHER_${code}`, JSON.stringify({ code, amount, validFor, limit, used: ex ? ex.used : 0 }));
              let l = await env.PREMIUM_DB.get("LIST_VOUCHERS", { type: "json" }) || [];
              if (!l.includes(code)) { l.push(code); await env.PREMIUM_DB.put("LIST_VOUCHERS", JSON.stringify(l)); }
              return new Response(JSON.stringify({ success: true }), { headers: corsHeaders });
          }
          if (url.pathname === "/api/admin/vouchers") {
              let list = await env.PREMIUM_DB.get("LIST_VOUCHERS", { type: "json" }) || [];
              let vouchers = [];
              for (const c of list) { const v = await env.PREMIUM_DB.get(`VOUCHER_${c}`, { type: "json" }); if(v) vouchers.push(v); }
              return new Response(JSON.stringify({ vouchers }), { headers: corsHeaders });
          }
          if (url.pathname === "/api/admin/del-voucher") {
              await env.PREMIUM_DB.delete(`VOUCHER_${body.code}`);
              let l = await env.PREMIUM_DB.get("LIST_VOUCHERS", { type: "json" }) || [];
              await env.PREMIUM_DB.put("LIST_VOUCHERS", JSON.stringify(l.filter(c => c !== body.code)));
              return new Response(JSON.stringify({ success: true }), { headers: corsHeaders });
          }
          if (url.pathname === "/api/admin/save-config") {
              await env.PREMIUM_DB.put("CONFIG_STORE", JSON.stringify(body));
              return new Response(JSON.stringify({ success: true }), { headers: corsHeaders });
          }
      }

      return new Response("Not Found", { status: 404 });
    }
  };

  async function recordSale(env, name, price, content) {
      let sales = await env.PREMIUM_DB.get("ADMIN_SALES", { type: "json" }) || [];
      sales.unshift({ date: new Date().toISOString(), name, price, content });
      if(sales.length > 500) sales = sales.slice(0, 500);
      await env.PREMIUM_DB.put("ADMIN_SALES", JSON.stringify(sales));
  }

  async function createPakasirTrx(amount, orderId, env) {
    try {
      const body = { project: env.PAKASIR_SLUG, order_id: orderId, amount: amount, api_key: env.PAKASIR_API_KEY };
      const req = await fetch('https://app.pakasir.com/api/transactioncreate/qris', {
          method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(body)
      });
      return { success: true, data: await req.json() };
    } catch(e) { return { success: false }; }
  }

  async function checkPakasirStatus(oid, amount, env) {
    try {
      const url = `https://app.pakasir.com/api/transactiondetail?project=${env.PAKASIR_SLUG}&amount=${amount}&order_id=${oid}&api_key=${env.PAKASIR_API_KEY}`;
      const req = await fetch(url);
      return { success: true, data: await req.json() };
    } catch(e) { return { success: false }; }
  }
