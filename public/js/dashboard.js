document.addEventListener("DOMContentLoaded", () => {
    // Mobile sidebar toggle
    const sidebar = document.querySelector(".sidebar");
    const toggleBtn = document.querySelector(".sidebar-toggle");

    if (sidebar && toggleBtn) {
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });
    }

    const cfg = window.DASHBOARD_CONFIG || {};
    const totalResults = Number(cfg.totalResults || 0);

    window.deleteResult = function deleteResult(id) {
        if (typeof Swal === "undefined") return;

        Swal.fire({
            title: "Delete Result?",
            text: "This action cannot be undone.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc2626",
            cancelButtonColor: "#6b7280",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/quiz-results/${id}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            ?.getAttribute("content"),
                        Accept: "application/json",
                    },
                })
                    .then((res) => res.json())
                    .then((data) => {
                        if (data && data.ok) {
                            Swal.fire({
                                title: "Successful!",
                                text: "Result deleted successfully.",
                                icon: "success",
                                confirmButtonColor: "#667eea",
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete result.",
                                icon: "error",
                                confirmButtonColor: "#667eea",
                            });
                        }
                    })
                    .catch((err) => {
                        console.error("Error:", err);
                        Swal.fire({
                            title: "Error!",
                            text: "An error occurred while deleting.",
                            icon: "error",
                            confirmButtonColor: "#667eea",
                        });
                    });
            }
        });
    };

    window.exportAllCSV = function exportAllCSV() {
        if (!cfg.exportCsvUrl) return;

        if (totalResults === 0) {
            alert("No results to export");
            return;
        }

        fetch(cfg.exportCsvUrl, {
            method: "GET",
            headers: {
                Accept: "text/csv",
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to export CSV");
                }
                return response.blob();
            })
            .then((blob) => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = cfg.exportCsvFilename || "quiz_results.csv";
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            })
            .catch((error) => {
                console.error("Error exporting CSV:", error);
                alert("Failed to export CSV");
            });
    };

    window.exportAllToSheets = function exportAllToSheets() {
        if (!cfg.exportSheetsUrl || typeof Swal === "undefined") return;

        if (totalResults === 0) {
            Swal.fire({
                title: "No results",
                text: "There are no quiz results to send yet.",
                icon: "info",
            });
            return;
        }

        Swal.fire({
            title: "Send to Google Sheets?",
            text: "All quiz results will be sent to Google Sheets.",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes, send",
        }).then((result) => {
            if (!result.isConfirmed) return;
            Swal.fire({
                title: "Sending...",
                text: "Please wait while we send data to Google Sheets.",
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            fetch(cfg.exportSheetsUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content"),
                    Accept: "application/json",
                },
                body: JSON.stringify({}),
            })
                .then((res) => res.json())
                .then((data) => {
                    Swal.close();
                    if (data && data.ok) {
                        Swal.fire({
                            title: "Success!",
                            text:
                                data.message ||
                                "All results sent to Google Sheets.",
                            icon: "success",
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text:
                                (data && data.message) ||
                                "Failed to send data to Google Sheets.",
                            icon: "error",
                        });
                    }
                })
                .catch((err) => {
                    console.error("Error exporting to sheets:", err);
                    Swal.close();
                    Swal.fire({
                        title: "Error",
                        text: "An error occurred while sending data.",
                        icon: "error",
                    });
                });
        });
    };
});
