document.addEventListener("DOMContentLoaded", function () {
    // Sample Reviews Data
    const reviews = [
        { id: "001", name: "Kris", review: "Amazing coffee!!", rating: 5 },
        { id: "002", name: "Christal", review: "Love the service", rating: 4 },
        { id: "003", name: "Angela", review: "Could be better", rating: 3 },
        { id: "004", name: "Jean", review: "Amazing experience", rating: 4 },
        { id: "005", name: "Marjorie", review: "Highly recommend", rating: 4 },
        { id: "006", name: "Gerald", review: "Quality is outstanding", rating: 3 },
    ];

    const tableBody = document.getElementById("review-table");

    // Function to Display Reviews
    function displayReviews() {
        tableBody.innerHTML = "";
        reviews.forEach((review) => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${review.id}</td>
                <td>${review.name}</td>
                <td>${review.review}</td>
                <td>${generateStars(review.rating)}</td>
                <td>
                    <button class="approve-btn" onclick="approveReview('${review.id}')">Approve</button>
                    <button class="delete-btn" onclick="deleteReview('${review.id}')">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Function to Generate Star Ratings
    function generateStars(rating) {
        let stars = "";
        for (let i = 0; i < rating; i++) {
            stars += "⭐";
        }
        return stars;
    }

    // Function to Approve Review
    window.approveReview = function (id) {
        alert(`Review ${id} Approved!`);
    };

    // Function to Delete Review
    window.deleteReview = function (id) {
        const index = reviews.findIndex((r) => r.id === id);
        if (index !== -1) {
            reviews.splice(index, 1);
            displayReviews();
        }
    };

    // Display Reviews on Load
    displayReviews();
});
