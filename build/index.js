(()=>{"use strict";const e=window.React,t=window.wp.element;(0,t.render)((0,e.createElement)((function(){const[a,n]=(0,t.useState)([]);return(0,t.useEffect)((()=>{(async()=>{try{const e=await fetch("/wp-json/efy/v1/trening");if(!e.ok)throw new Error("Failed to fetch data");const t=await e.json();n(t)}catch(e){console.error(e)}})()}),[]),(0,e.createElement)("div",{className:"training_list"},a.map((t=>(0,e.createElement)("div",{className:"training_box",key:t.id},(0,e.createElement)("div",{className:"training_thumb"},(0,e.createElement)("a",{href:`/trening/${t.slug}`},t.thumbnail&&(0,e.createElement)("img",{src:t.thumbnail.medium}))),(0,e.createElement)("h2",{className:"training_title"},(0,e.createElement)("a",{href:`/trening/${t.slug}`},t.title)),t.termin&&(0,e.createElement)("div",{className:"training_date"},t.termin,"  ",t.czas_trwania&&(0,e.createElement)("span",null,"Czas trwania: ",t.czas_trwania)),t.krotki_opis&&(0,e.createElement)("div",{className:"training_desc"},t.krotki_opis),t.cena&&(0,e.createElement)("div",{className:"training_price"},t.cena),t.prowadzacy&&(0,e.createElement)("div",{className:"training_person"},"Prowadzący: ",(0,e.createElement)("span",null,t.prowadzacy))))))}),null),document.getElementById("lista-treningow"))})();