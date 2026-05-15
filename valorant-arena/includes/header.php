<?php 
// Global Session and Config Management
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Absolute Path definition for robustness
define('BASE_PATH', __DIR__ . '/../');
require_once BASE_PATH . 'config.php'; 
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pakistan's Premier Valorant Tournament Hub - Organized by Tec Traders">
    <title>VALORANT ARENA S2 | Tactical Excellence</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Oswald:wght@200;400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        valRed: '#ff4655',
                        valGold: '#d4af37',
                        valDark: '#0f1923',
                        valBlack: '#0b0f12',
                        valBeige: '#ece8e1'
                    }
                }
            }
        }
    </script>
    
    <style>
        :root {
            --val-red: #ff4655;
            --val-gold: #d4af37;
            --val-dark: #0f1923;
            --val-black: #0b0f12;
        }

        body { 
            background: var(--val-black); 
            color: #ece8e1; 
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            letter-spacing: -0.01em;
        }

        .oswald { font-family: 'Oswald', sans-serif; }

        /* Tactical Background Grid */
        .bg-grid {
            background-image: radial-gradient(rgba(255, 70, 85, 0.05) 1px, transparent 0);
            background-size: 40px 40px;
        }

        /* Valorant Style Polygon Clip */
        .clip-v {
            clip-path: polygon(0 0, 100% 0, 100% 85%, 95% 100%, 0 100%);
        }

        /* Neon & Effects */
        .neon-text-red { text-shadow: 0 0 10px rgba(255, 70, 85, 0.5); }
        .neon-border-gold { box-shadow: 0 0 15px rgba(212, 175, 55, 0.2); }

        .btn-valorant {
            position: relative;
            background: var(--val-gold);
            color: #000;
            padding: 14px 28px;
            font-family: 'Oswald', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            clip-path: polygon(8% 0, 100% 0, 92% 100%, 0% 100%);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-valorant:hover {
            background: #fff;
            transform: translateX(4px);
            box-shadow: -4px 0 0 var(--val-red);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--val-black); }
        ::-webkit-scrollbar-thumb { background: var(--val-red); }
        
        /* Smooth Entry Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-entry { animation: fadeIn 0.8s ease forwards; }
    </style>
</head>
<body class="selection:bg-valRed selection:text-white bg-grid">
<?php include_once BASE_PATH . 'includes/navbar.php'; ?>