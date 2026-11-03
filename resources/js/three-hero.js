// ============================================================
// SarkariCourse — Real Interactive 3D Hero (Three.js)
// Renders a floating graduation-cap + book-stack + orbiting ring
// composed from primitive geometry (kept lightweight — no heavy
// external .glb models — so the hero paints instantly on any device).
// Mounts into any element with [data-three-hero], lazy-initialised
// only when that element scrolls into view.
// ============================================================
import * as THREE from 'three';

function buildScene(container) {
    const width = container.clientWidth;
    const height = container.clientHeight;

    const scene = new THREE.Scene();

    const camera = new THREE.PerspectiveCamera(38, width / height, 0.1, 100);
    camera.position.set(0, 0.4, 7);

    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    container.appendChild(renderer.domElement);

    // ── Lighting ──────────────────────────────────
    scene.add(new THREE.AmbientLight(0xffffff, 0.65));
    const key = new THREE.DirectionalLight(0xffffff, 1.1);
    key.position.set(4, 6, 5);
    scene.add(key);
    const rim = new THREE.PointLight(0x8b5cf6, 2.4, 20);
    rim.position.set(-4, -2, 3);
    scene.add(rim);
    const rim2 = new THREE.PointLight(0xf59e0b, 1.2, 20);
    rim2.position.set(3, -3, -2);
    scene.add(rim2);

    // ── Group holding everything (rotates with mouse) ──
    const rig = new THREE.Group();
    scene.add(rig);

    const purple = new THREE.MeshStandardMaterial({ color: 0x6d28d9, roughness: 0.35, metalness: 0.25 });
    const purpleDark = new THREE.MeshStandardMaterial({ color: 0x2e1065, roughness: 0.4, metalness: 0.2 });
    const gold = new THREE.MeshStandardMaterial({ color: 0xf59e0b, roughness: 0.3, metalness: 0.6 });
    const white = new THREE.MeshStandardMaterial({ color: 0xffffff, roughness: 0.5, metalness: 0.05 });
    const accentBook = new THREE.MeshStandardMaterial({ color: 0x8b5cf6, roughness: 0.4, metalness: 0.1 });

    // Book stack
    const bookStack = new THREE.Group();
    const bookColors = [purple, accentBook, purpleDark];
    bookColors.forEach((mat, i) => {
        const book = new THREE.Mesh(new THREE.BoxGeometry(2.6 - i * 0.15, 0.28, 1.7 - i * 0.1), mat);
        book.position.y = -1.1 + i * 0.32;
        bookStack.add(book);
    });
    bookStack.position.set(0, -0.4, 0);
    rig.add(bookStack);

    // Graduation cap (board + button + tassel), floats above books
    const capGroup = new THREE.Group();
    const board = new THREE.Mesh(new THREE.BoxGeometry(2.3, 0.12, 2.3), purpleDark);
    board.rotation.y = Math.PI / 4;
    capGroup.add(board);
    const capBase = new THREE.Mesh(new THREE.CylinderGeometry(0.55, 0.65, 0.55, 24), purpleDark);
    capBase.position.y = -0.32;
    capGroup.add(capBase);
    const button = new THREE.Mesh(new THREE.SphereGeometry(0.09, 16, 16), gold);
    button.position.y = 0.08;
    capGroup.add(button);
    const tassel = new THREE.Mesh(new THREE.CylinderGeometry(0.02, 0.02, 1, 8), gold);
    tassel.position.set(0.9, -0.4, 0.9);
    tassel.rotation.z = 0.3;
    capGroup.add(tassel);
    capGroup.position.set(0, 1.55, 0);
    capGroup.rotation.x = -0.08;
    rig.add(capGroup);

    // Orbiting ring (subtle depth element)
    const ring = new THREE.Mesh(
        new THREE.TorusGeometry(2.9, 0.02, 8, 100),
        new THREE.MeshStandardMaterial({ color: 0x8b5cf6, roughness: 0.6, transparent: true, opacity: 0.35 })
    );
    ring.rotation.x = Math.PI / 2.3;
    rig.add(ring);

    // Floating trophy accent (simple cone + sphere)
    const trophy = new THREE.Group();
    const cup = new THREE.Mesh(new THREE.SphereGeometry(0.35, 20, 20, 0, Math.PI * 2, 0, Math.PI / 1.6), gold);
    trophy.add(cup);
    const stem = new THREE.Mesh(new THREE.CylinderGeometry(0.06, 0.12, 0.4, 12), gold);
    stem.position.y = -0.45;
    trophy.add(stem);
    trophy.position.set(2.6, -0.6, 0.6);
    trophy.scale.setScalar(0.9);
    rig.add(trophy);

    // Particle sparkles
    const sparkleGeo = new THREE.BufferGeometry();
    const sparkleCount = 60;
    const positions = new Float32Array(sparkleCount * 3);
    for (let i = 0; i < sparkleCount; i++) {
        positions[i * 3] = (Math.random() - 0.5) * 8;
        positions[i * 3 + 1] = (Math.random() - 0.5) * 6;
        positions[i * 3 + 2] = (Math.random() - 0.5) * 4;
    }
    sparkleGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    const sparkles = new THREE.Points(sparkleGeo, new THREE.PointsMaterial({ color: 0xd8b4fe, size: 0.035, transparent: true, opacity: 0.7 }));
    scene.add(sparkles);

    // ── Interaction state ──────────────────────────
    let targetRotX = 0, targetRotY = 0;
    let mouseX = 0, mouseY = 0;

    container.addEventListener('pointermove', (e) => {
        const rect = container.getBoundingClientRect();
        mouseX = ((e.clientX - rect.left) / rect.width) * 2 - 1;
        mouseY = ((e.clientY - rect.top) / rect.height) * 2 - 1;
        targetRotY = mouseX * 0.35;
        targetRotX = mouseY * -0.2;
    });
    container.addEventListener('pointerleave', () => { targetRotX = 0; targetRotY = 0; });

    let raf;
    const clock = new THREE.Clock();
    function animate() {
        raf = requestAnimationFrame(animate);
        const t = clock.getElapsedTime();

        rig.rotation.y += (targetRotY - rig.rotation.y) * 0.06;
        rig.rotation.x += (targetRotX - rig.rotation.x) * 0.06;

        capGroup.position.y = 1.55 + Math.sin(t * 1.2) * 0.12;
        capGroup.rotation.y = Math.sin(t * 0.6) * 0.15;
        trophy.position.y = -0.6 + Math.sin(t * 1.6 + 1) * 0.1;
        ring.rotation.z = t * 0.15;
        sparkles.rotation.y = t * 0.05;

        renderer.render(scene, camera);
    }
    animate();

    // Resize handling
    const ro = new ResizeObserver(() => {
        const w = container.clientWidth, h = container.clientHeight;
        if (!w || !h) return;
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
        renderer.setSize(w, h);
    });
    ro.observe(container);

    return () => {
        cancelAnimationFrame(raf);
        ro.disconnect();
        renderer.dispose();
        container.removeChild(renderer.domElement);
    };
}

function initThreeHeroes() {
    const targets = document.querySelectorAll('[data-three-hero]');
    if (!targets.length) return;

    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting && !entry.target.dataset.threeMounted) {
                entry.target.dataset.threeMounted = '1';
                buildScene(entry.target);
                io.unobserve(entry.target);
            }
        });
    }, { rootMargin: '200px' });

    targets.forEach((el) => io.observe(el));
}

initThreeHeroes();
export default initThreeHeroes;
