const skuRolling = {
    "ANNABEL LEE": 100,
    "REMEDIA AMORIS": 100,
    "SONNET 116": 100,
    TRAUMEREI: 100,
    "AM KAMIN": 100,

    "KIE RAHA": 40,
    LOUI: 40,
    SOTB: 40,
    MALEALI: 40,
    MORFOSIA: 40,

    "RAE NIRA": 30,
    "LAS POZAS": 30,
    SOFR: 30,
    COCO: 30,
    OSTARA: 30,

    OMNIA: 20,
    "IRAI LEIMA": 20,
    MINOUET: 20,
    SAFF: 20,
    KIRITHRA: 20,

    CHNO: 10,
    ILIAD: 10,
    XOCOLATL: 10,
    SOLARIS: 10,
    TROUPE: 10,
};

function calculateResult() {
    const categories = { A: 0, B: 0, C: 0, D: 0, E: 0 };

    const q1 = document.querySelector("input[name='q1']:checked")?.value;
    const q3 = document.querySelector("input[name='q3']:checked")?.value;
    const q4 = document.querySelector("input[name='q4']:checked")?.value;
    const q5 = document.querySelector("input[name='q5']:checked")?.value;
    const q6 = document.querySelector("input[name='q6']:checked")?.value;
    const q2 = document.getElementById("q2").value;

    if (!q1 || !q3 || !q4 || !q5 || !q6) {
        Swal.fire({
            icon: "warning",
            title: "Ups!",
            text: "Please answer all required questions (Q1, Q3 – Q6).",
        });
        return;
    }

    // scoring
    categories[q1] += 1;
    categories[q3] += 1;
    categories[q4] += 2;
    categories[q5] += 2;
    categories[q6] += 2;

    // pick winner
    let winner = Object.keys(categories).reduce((a, b) =>
        categories[a] > categories[b] ? a : b
    );

    const resultData = {
        A: {
            title: "COZY & HOME",
            desc: "The feeling of coming home, wherever you are.",
            full: ["KIE RAHA", "RAE NIRA", "OMNIA", "CHNO"],
            mist: ["Remedia Amoris"],
        },
        B: {
            title: "MINIMALIST & CLEAN",
            desc: "Clear space, clear mind.",
            full: ["LOUI", "LAS POZAS", "IRAI LEIMA", "ILIAD"],
            mist: ["Sonnet 116"],
        },
        C: {
            title: "CHEERFUL & SWEET",
            desc: "Light energy, easy comfort.",
            full: ["SOTB", "SOFR", "MINOUET", "XOCOLATL"],
            mist: ["Annabel Lee"],
        },
        D: {
            title: "BOLD & DEEP",
            desc: "Quiet confidence with a lasting impression.",
            full: ["MALEALI", "COCO", "SAFF", "SOLARIS"],
            mist: ["Träumerei", "Am Kamin"],
        },
        E: {
            title: "WANDER & ARTISTIC",
            desc: "Thoughtful, reflective, and quietly creative.",
            full: ["MORFOSIA", "OSTARA", "KIRITHRA", "TROUPE"],
            mist: ["Sonnet 116"],
        },
    };

    const winnerData = resultData[winner];

    // Calculate rolling %
    const rollingList = [...winnerData.full, ...winnerData.mist].map(
        (sku) => `${sku} (${skuRolling[sku]}%)`
    );

    // SAVE EXPORT DATA
    window.quizExportData = {
        Q1: q1,
        Q2: q2,
        Q3: q3,
        Q4: q4,
        Q5: q5,
        Q6: q6,
        ScoreA: categories["A"],
        ScoreB: categories["B"],
        ScoreC: categories["C"],
        ScoreD: categories["D"],
        ScoreE: categories["E"],
        FinalCategory: winner,
        FinalCategoryName: winnerData.title,
        RollingList: rollingList.join(" | "),
    };

    Swal.fire({
        icon: "success",
        title: "Your Identity Category",
        html: `
      <h2>${winnerData.title}</h2>
      <p>${winnerData.desc}</p>
      <br>
      <b>Recommended SKU:</b><br>
      ${winnerData.full.join(", ")}<br>
      <i>${winnerData.mist.join(", ")}</i>
    `,
        confirmButtonText: "Thank You!",
    }).then(() => {
        // Reset quiz inputs and show confirmation screen
        document.querySelectorAll("input[type='radio']").forEach((el) => {
            el.checked = false;
        });
        const q2Input = document.getElementById("q2");
        if (q2Input) q2Input.value = "";

        const quizContainer = document.querySelector(".quiz-container");
        const thankyou = document.getElementById("quiz-thankyou");
        if (quizContainer && thankyou) {
            quizContainer.style.display = "none";
            thankyou.style.display = "block";
        }

        // Show export / Google Sheets buttons now that we have data
        const exportBtn = document.getElementById("exportBtn");
        const sheetsBtn = document.getElementById("googleSheetsBtn");
        if (exportBtn) exportBtn.style.display = "inline-block";
        if (sheetsBtn) sheetsBtn.style.display = "inline-block";
    });

    // Send to server to persist result (if CSRF token present)
    try {
        const token = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");
        if (token) {
            fetch("/quiz/submit", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                    Accept: "application/json",
                },
                body: JSON.stringify(window.quizExportData),
            })
                .then((res) => res.json())
                .then((json) => {
                    if (json && json.ok) {
                        window.quizExportData.server_id = json.id;
                        console.log("Saved quiz result id", json.id);
                    }
                })
                .catch((err) =>
                    console.error("Error saving quiz result:", err)
                );
        }
    } catch (e) {
        console.error(e);
    }
}

function exportCSV() {
    const data = window.quizExportData;

    if (!data) {
        Swal.fire({
            icon: "error",
            title: "Oops!",
            text: "Finish the quiz first!",
        });
        return;
    }

    Swal.fire({
        icon: "info",
        title: "Download CSV?",
        text: "Your quiz result will be downloaded.",
        showCancelButton: true,
        confirmButtonText: "Yes, download",
    }).then((res) => {
        if (!res.isConfirmed) return;

        const headers = Object.keys(data).join(",");
        const values = Object.values(data)
            .map((v) =>
                typeof v === "string" && v.includes(",") ? `"${v}"` : v
            )
            .join(",");

        const csv = headers + "\n" + values;

        const blob = new Blob([csv], { type: "text/csv" });
        const url = URL.createObjectURL(blob);

        const a = document.createElement("a");
        a.href = url;
        a.download = "quiz_result.csv";
        a.click();

        URL.revokeObjectURL(url);
    });
}

async function sendToGoogleSheets() {
    const data = window.quizExportData;

    if (!data) {
        Swal.fire({
            icon: "error",
            title: "Oops!",
            text: "Finish the quiz first!",
        });
        return;
    }

    const timestamp = new Date().toLocaleString();
    const payloadData = { ...data, Timestamp: timestamp };

    try {
        const GOOGLE_SCRIPT_URL =
            "https://script.google.com/macros/s/AKfycbxmZcHytVA3jZHFxd_z3smotv9n2BYFXnvdjnUdRuYHt17h4xbLrppitdt7zyrNRUTFlA/exec";

        await fetch(GOOGLE_SCRIPT_URL, {
            method: "POST",
            mode: "no-cors",
            body: JSON.stringify(payloadData),
        });

        Swal.fire({
            icon: "success",
            title: "Success!",
            text: "Your result has been sent to Google Sheets.",
            timer: 2000,
        });
    } catch (error) {
        console.error("Error sending to Google Sheets:", error);
        Swal.fire({
            icon: "error",
            title: "Oops!",
            text: "Failed to send data. Please try again.",
        });
    }
}

function restartQuiz() {
    const quizContainer = document.querySelector(".quiz-container");
    const thankyou = document.getElementById("quiz-thankyou");
    if (quizContainer && thankyou) {
        quizContainer.style.display = "block";
        thankyou.style.display = "none";
    }

    document.querySelectorAll("input[type='radio']").forEach((el) => {
        el.checked = false;
    });
    const q2Input = document.getElementById("q2");
    if (q2Input) q2Input.value = "";

    const exportBtn = document.getElementById("exportBtn");
    const sheetsBtn = document.getElementById("googleSheetsBtn");
    if (exportBtn) exportBtn.style.display = "none";
    if (sheetsBtn) sheetsBtn.style.display = "none";
}
