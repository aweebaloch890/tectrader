<?php 
include_once 'config.php'; 
include 'includes/header.php'; 
include 'includes/navbar.php'; 

// Basic Security: Check if user is logged in
if(!is_logged_in()){
    header("Location: login.php");
    exit();
}
?>

<div class="min-h-screen bg-[#0b0f12] py-16">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="relative mb-12 p-10 bg-[#0f1923] border-b-4 border-[#ff4655] shadow-2xl overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <i class="fas fa-shield-alt text-8xl text-white"></i>
            </div>
            
            <div class="relative z-10 text-center">
                <h2 class="text-[#ff4655] oswald tracking-[0.6em] text-[10px] font-black mb-4 uppercase italic">
                    // Protocol: Map Selection Phase
                </h2>
                <h1 class="text-6xl md:text-7xl font-black oswald italic uppercase text-white leading-none">
                    VETO <span class="text-[#d4af37]">COMMAND</span> CENTER
                </h1>
                
                <div class="flex flex-wrap justify-center items-center gap-6 mt-8">
                    <div class="px-6 py-3 bg-black/40 border border-white/5 backdrop-blur-md">
                        <p class="text-[9px] text-gray-500 font-bold tracking-widest uppercase mb-1">Current Turn</p>
                        <span class="text-xl font-black oswald uppercase italic text-[#ff4655]" id="active-team text-glow">TEAM A</span>
                    </div>
                    <div class="w-12 h-[2px] bg-white/10 hidden md:block"></div>
                    <div class="px-6 py-3 bg-black/40 border border-white/5 backdrop-blur-md">
                        <p class="text-[9px] text-gray-500 font-bold tracking-widest uppercase mb-1">Required Action</p>
                        <span id="action-type" class="text-xl font-black oswald uppercase italic text-[#d4af37]">INITIALIZING...</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <div class="lg:col-span-1">
                <div class="bg-[#0f1923] border border-white/5 h-full flex flex-col">
                    <div class="p-4 border-b border-white/5 bg-white/5">
                        <h3 class="oswald text-sm font-black italic uppercase tracking-widest text-white flex items-center">
                            <span class="w-2 h-2 bg-[#ff4655] mr-3 animate-pulse"></span> Tactical Log
                        </h3>
                    </div>
                    <div id="veto-log" class="p-6 text-[11px] font-bold uppercase tracking-wider space-y-3 h-[500px] overflow-y-auto custom-scrollbar italic text-gray-400">
                        <div class="animate-pulse">Waiting for synchronization...</div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="map-pool">
                    </div>
            </div>
        </div>
    </div>
</div>

<style>
    .map-card {
        height: 220px;
        background-size: cover;
        background-position: center;
        position: relative;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        border: 1px solid rgba(255,255,255,0.05);
    }
    
    .map-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15,25,35,1) 0%, rgba(15,25,35,0.2) 100%);
        z-index: 1;
        transition: 0.3s;
    }

    .map-card:hover:not(.disabled) {
        transform: scale(1.02);
        border-color: #ff4655;
        box-shadow: 0 0 30px rgba(255, 70, 85, 0.2);
    }

    .map-card.banned {
        filter: grayscale(1) brightness(0.3);
        cursor: not-allowed;
    }

    .map-card.banned::after {
        content: 'ELIMINATED';
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%) rotate(-10deg);
        color: #ff4655;
        font-family: 'Oswald', sans-serif;
        font-size: 2.5rem;
        font-weight: 900;
        z-index: 10;
        border: 4px solid #ff4655;
        padding: 0 15px;
        letter-spacing: 2px;
    }

    .map-card.picked {
        border: 3px solid #d4af37;
    }

    .map-card.picked::after {
        content: 'SELECTED';
        position: absolute;
        top: 15px; right: 15px;
        background: #d4af37;
        color: black;
        padding: 2px 10px;
        font-family: 'Oswald', sans-serif;
        font-size: 0.8rem;
        font-weight: 900;
        z-index: 10;
    }

    .map-card.decider {
        border: 3px solid #ff4655;
        animation: glow 1.5s infinite alternate;
    }

    @keyframes glow {
        from { box-shadow: 0 0 10px rgba(255, 70, 85, 0.2); }
        to { box-shadow: 0 0 30px rgba(255, 70, 85, 0.5); }
    }

    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #ff4655; }
</style>

<script>
const maps = [
    { name: "Ascent", img: "https://titles.trackercdn.com/valorant-api/maps/7eaecc1b-4337-bbf6-6130-0388b051c759/listviewicon.png" },
    { name: "Bind", img: "https://titles.trackercdn.com/valorant-api/maps/2c9dba14-44a3-4459-d712-63bc3e302e10/listviewicon.png" },
    { name: "Haven", img: "https://titles.trackercdn.com/valorant-api/maps/2bee0dc9-4ffe-519b-1cbd-7d16363077a9/listviewicon.png" },
    { name: "Icebox", img: "https://titles.trackercdn.com/valorant-api/maps/e2ad5c54-4114-a870-9641-8f2127953331/listviewicon.png" },
    { name: "Lotus", img: "https://titles.trackercdn.com/valorant-api/maps/2fe4ed3a-450a-948b-9245-184477c0abc6/listviewicon.png" },
    { name: "Split", img: "https://titles.trackercdn.com/valorant-api/maps/d960547d-44f3-9976-2459-ca46f4e10915/listviewicon.png" },
    { name: "Sunset", img: "https://titles.trackercdn.com/valorant-api/maps/9203f26d-44b7-0062-7c30-31e42823000b/listviewicon.png" }
];

let currentStep = 0;
const sequence = [
    { team: "Team A", action: "BAN" },
    { team: "Team B", action: "BAN" },
    { team: "Team A", action: "PICK" },
    { team: "Team B", action: "PICK" },
    { team: "Team A", action: "BAN" },
    { team: "Team B", action: "BAN" }
];

let bannedMaps = [];
let pickedMaps = [];

function initMaps() {
    const pool = document.getElementById('map-pool');
    pool.innerHTML = '';
    maps.forEach((map, index) => {
        pool.innerHTML += `
            <div id="map-${index}" onclick="handleVeto(${index})" 
                class="map-card group cursor-pointer flex items-end p-6 overflow-hidden" 
                style="background-image: url('${map.img}')">
                <div class="relative z-10">
                    <span class="block text-[10px] text-[#ff4655] font-black tracking-[0.3em] opacity-0 group-hover:opacity-100 transition-all uppercase">Analyze Map</span>
                    <span class="text-3xl font-black oswald uppercase italic text-white tracking-tighter">${map.name}</span>
                </div>
            </div>`;
    });
    updateUI();
}

function handleVeto(index) {
    if(currentStep >= sequence.length) return;
    
    const mapCard = document.getElementById(`map-${index}`);
    if(mapCard.classList.contains('banned') || mapCard.classList.contains('picked')) return;

    const stepInfo = sequence[currentStep];
    const log = document.getElementById('veto-log');
    
    if(currentStep === 0) log.innerHTML = '';

    if(stepInfo.action === "BAN") {
        mapCard.classList.add('banned', 'disabled');
        bannedMaps.push(index);
        log.innerHTML += `
            <div class="p-3 bg-red-500/5 border-l-2 border-red-500 text-white flex justify-between">
                <span>${stepInfo.team} ELIMINATED ${maps[index].name}</span>
                <span class="text-red-500">[BAN]</span>
            </div>`;
    } else {
        mapCard.classList.add('picked', 'disabled');
        pickedMaps.push(index);
        log.innerHTML += `
            <div class="p-3 bg-[#d4af37]/5 border-l-2 border-[#d4af37] text-white flex justify-between">
                <span>${stepInfo.team} AUTHORIZED ${maps[index].name}</span>
                <span class="text-[#d4af37]">[PICK]</span>
            </div>`;
    }

    currentStep++;
    
    // Check if it's the end to find Decider
    if(currentStep === sequence.length) {
        const remainingIndex = maps.findIndex((_, i) => 
            !bannedMaps.includes(i) && !pickedMaps.includes(i)
        );
        
        if(remainingIndex !== -1) {
            const deciderCard = document.getElementById(`map-${remainingIndex}`);
            deciderCard.classList.add('decider');
            log.innerHTML += `
                <div class="p-3 bg-white/10 border-l-2 border-white text-[#d4af37] mt-4 font-black">
                    SYSTEM: DECIDER MAP AUTOMATICALLY SET TO ${maps[remainingIndex].name.toUpperCase()}
                </div>`;
        }
    }
    
    updateUI();
}

function updateUI() {
    const teamDisp = document.getElementById('active-team');
    const actionDisp = document.getElementById('action-type');

    if(currentStep < sequence.length) {
        teamDisp.innerText = sequence[currentStep].team;
        actionDisp.innerText = sequence[currentStep].action;
        actionDisp.className = (sequence[currentStep].action === "BAN") 
            ? "text-xl font-black oswald uppercase italic text-[#ff4655]" 
            : "text-xl font-black oswald uppercase italic text-[#d4af37]";
    } else {
        teamDisp.innerText = "SEQUENCE";
        teamDisp.className = "text-xl font-black oswald uppercase italic text-green-500";
        actionDisp.innerText = "COMPLETE";
        actionDisp.className = "text-xl font-black oswald uppercase italic text-green-500";
    }
}

initMaps();
</script>

<?php include 'includes/footer.php'; ?>