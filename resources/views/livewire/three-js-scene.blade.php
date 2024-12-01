<div wire:ignore>
    <canvas id="threejs-canvas"></canvas>
</div>

<div>
    <label>Width:</label>
    <input type="number" wire:model="width" wire:change="updateDimensions($event.target.value, $this->height, $this->depth)">
    
    <label>Height:</label>
    <input type="number" wire:model="height" wire:change="updateDimensions($this->width, $event.target.value, $this->depth)">
    
    <label>Depth:</label>
    <input type="number" wire:model="depth" wire:change="updateDimensions($this->width, $this->height, $event.target.value)">
    
    <label>Color:</label>
    <input type="color" wire:model="color" wire:change="updateColor($event.target.value)">
</div>

<script>
    let cube;

    document.addEventListener('DOMContentLoaded', function () {
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('threejs-canvas') });
        
        renderer.setSize(window.innerWidth, window.innerHeight);
        camera.position.z = 5;

        function createCube(width, height, depth, color) {
            if (cube) {
                scene.remove(cube); // Remove the old cube
            }
            const geometry = new THREE.BoxGeometry(width, height, depth);
            const material = new THREE.MeshBasicMaterial({ color: color });
            cube = new THREE.Mesh(geometry, material);
            scene.add(cube);
        }

        createCube(@this.width, @this.height, @this.depth, @this.color); // Initial cube creation

        Livewire.on('updateCube', () => {
            createCube(@this.width, @this.height, @this.depth, @this.color); // Update cube on event
        });

        function animate() {
            requestAnimationFrame(animate);
            if (cube) {
                cube.rotation.x += 0.01;
                cube.rotation.y += 0.01;
            }
            renderer.render(scene, camera);
        }
        animate();
    });
</script> 