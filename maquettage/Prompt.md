#  Maquette Prompt: "Casa Innov'" Blog

After reading and processing the use case diagram and the list of features provided, this document organizes the requirements for creating a modern and responsive HTML + Tailwind CSS mockup for the blog **"Casa Innov' – Casablanca's Innovation Hub"**.

---

### **1. Public Side (for Amine the Reader & Sara the Contributor)**

**Goal:** Allow users (founders, developers, students) to discover high-quality, locally-relevant content about Casablanca's innovation scene and enable contributors to share their expertise.

**Design Guidelines:**

-   **Visual Theme:** Inspired by modern tech hubs, coworking spaces, and the dynamic energy of Casablanca's business scene. Clean, professional, and trustworthy.
-   **Color Palette:** Professional and energetic tones (Deep Blue `#0A2540`, Electric Cyan `#00C4FF`, Dark Grey `#333333`, Clean White `#FFFFFF`).
-   **Architectural Accents:** Minimalist design with sharp lines, good use of white space, and modern, readable typography (e.g., Inter, Poppins).
-   **Prioritization:** Mobile-first, fast-loading, and focused on readability.

**Sections to Include:**

-   **Header / Navbar**
    -   **Logo:** "Casa Innov'"
    -   **Menu Links:** "Home", "Posts", "Tags", "Submit a Post"
    -   **Utilities:** Search bar and "Login/Register" buttons.
-   **Hero Section**
    -   **Background:** High-quality image of a modern coworking space in Casablanca or an abstract tech graphic.
    -   **Title:** "Casablanca's Innovation Hub: Learn, Share, Grow."
    -   **CTA Buttons:** "Explore Posts" and "Become a Contributor".
-   **Featured Posts Section**
    -   **Layout:** A clean grid of cards with post images, titles, author names, and a few tags.
    -   **Buttons:** "Read Post" and a "Save for Later" icon (like a bookmark).

---

### **2. Private Side (for Ayoub the Admin)**

**Goal:** Enable administrators to efficiently manage all content and users to maintain the blog's quality and relevance.

**Design Guidelines:**

-   **Color Palette:** Same as public side, perhaps with a slightly darker background for a focused, dashboard feel.
-   **Components:** Use standard Tailwind CSS components (cards, tables, modals, buttons, alerts) for a clean and functional UI.
-   **Layout:** A standard sidebar navigation layout for the dashboard.

**Sections to Include:**

-   **Login Page**
    -   **Layout:** Simple, centered login card with the "Casa Innov'" logo.
    -   **Fields:** Email and Password.
    -   **Button:** "Login".
-   **Admin Dashboard**
    -   **Sidebar Navigation Links:**
        -   Dashboard (Overview)
        -   Manage Posts
        -   Manage Users
    -   **Main Content Area (Dashboard):**
        -   Quick stats cards (Total Posts, Pending Submissions, Total Users).
        -   A table showing the latest **pending posts** for quick review.
    -   **Main Content Area (Manage Posts):**
        -   A full table of all posts with filters (by status, by author).
        -   Table columns: Title, Author, Status, Date.
        -   Action buttons for each post: "Approve", "Reject", "Edit", "Delete".
        -   A primary button to "Add New Post" (for Admin-written content).

---

### **3. Technical Details**

-   **Styling:** Use **Tailwind CSS** for all styling.
-   **HTML Structure:** Apply HTML5 semantic structure (`header`, `nav`, `main`, `article`, `section`, `footer`).
-   **Modularity:** All components (buttons, cards, forms) must be modular and reusable.
-   **Responsiveness:** Ensure a seamless responsive design for mobile, tablet, and desktop.
-   **Animations:** Include minimal and professional animations using Tailwind's transition classes.

### **4. Optional Enhancements**

-   Subtle motion effects (fade-in on scroll) for the post cards.
-   Use **Lucide** or **Font Awesome** icons for all UI elements (search, edit, delete, tags).
-   Add a **dark mode toggle** in the navbar for better accessibility.
-   Use the **Tailwind Typography plugin** to ensure articles are beautifully formatted and highly readable.

### **5. Output Format**

Generate the following HTML files:

-   `index.html`: Public homepage.
-   `posts.html`: Public page listing all posts (the blog feed).
-   `post-detail.html`: Example of a single post page.
-   `login.html`: Login page (for all users).
-   `register.html`: Registration page.
-   `admin-dashboard.html`: Admin main panel (overview).
-   `admin-posts-list.html`: Admin page for managing all posts.
-   `admin-post-edit.html`: Admin form for editing or creating a post.

Each page should be well-commented, with clear section labels for easy iteration and integration into Laravel.

### **6. Theme Inspiration**

The design should evoke:

-   The professionalism and ambition of a **tech startup**.
-   The collaborative spirit of platforms like **Medium** or **Dev.to**.
-   A blend of modern digital design and the vibrant, forward-thinking energy of **Casablanca**.