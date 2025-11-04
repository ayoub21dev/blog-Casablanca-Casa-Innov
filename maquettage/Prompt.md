# AI Design Prompt: "Casa Innov' Blog" Mockup

---

### 🎯 **1. Project Context**

A collaborative blog dedicated to Casablanca's innovation ecosystem (startups, tech, creativity).
**Objective:** To centralize high-quality local knowledge, help founders and professionals learn from each other, and allow contributors to share their expertise, in order to energize the city's tech community and strengthen engagement around innovation.

---

### 🎨 **2. Style & Design**

-   **Style:** Modern, clean, professional, with a tech/innovation inspiration 💡.
-   **Color Palette:**
    -   Deep Blue (`#0A2540`) - for professionalism and text.
    -   Electric Cyan (`#00C4FF`) - for accents, links, and calls-to-action.
    -   Dark Grey (`#333333`) - for secondary text.
    -   Clean White (`#FFFFFF`) - for backgrounds.
-   **Layout:** Full-width, highly readable fonts (e.g., Inter, Poppins), minimal unnecessary scrolling.
-   **Aesthetic:** Tech blog / Professional platform.
-   **Framework Inspiration:** Bootstrap 5 (grid system, cards, forms) + smooth, subtle animations.

---

### 🧱 **3. Pages to Be Planned**

-   **Admin Section:**
    -   Manage Posts (CRUD)
    -   Approve/Reject Submissions
-   **Public Section:**
    -   Home
    -   Posts (Blog feed)
    -   Post Page (Details)
    -   Author Page (Profile)

---

### 📌 **4. Main Sections**

-   Header + clear navigation menu (Home, Posts, Submit a Post, Login/Register).
-   Hero section with a modern image of a Casablanca tech hub or a coworking space.
-   Post list (card grid layout).
-   Footer (About link, contact, social media).

---

### 🧑‍🤝‍🧑 **5. User Experience**

-   **Fully responsive** (mobile / tablet / desktop).
-   Clear and intuitive navigation.
-   Clean and focused reading experience on the post detail page.
-   **Quick filter functionality** using clickable tags.

---

### ⚙️ **6. Technologies & Assets (for mockup)**

-   Inspiration from **HTML + Bootstrap 5** structure.
-   Icons from **FontAwesome**.
-   CSS for colors and typography.
-   **One high-fidelity mockup image for each key view.**

---

### ✍️ **7. Expected Deliverables**

-   High-fidelity mockup images (PNG/JPG) for each page listed in the site map.
-   The design must be responsive; **provide both a desktop view and a mobile view** for the Home and Post Detail pages.
-   A simple style guide image showing the color palette and typography used.

---

### 📊 **Use Case Diagram**

```plantuml
@startuml
left to right direction

' --- Actors ---
actor "Amine\n(Reader)" as Amine
actor "Sara\n(Contributor)" as Sara
actor "Ayoub\n(Admin)" as Ayoub

' --- System and Use Cases ---
rectangle "Casa Innov' Blog" {
  usecase "Browse Posts" as UC_Browse
  usecase "Filter Posts\n(by tag)" as UC_Filter
  usecase "Read Post Details" as UC_Read
  usecase "Add Comment" as UC_Comment
  usecase "Submit Post" as UC_Submit
  usecase "Manage Own Posts" as UC_ManageOwn
  usecase "Manage All Posts\n(Approve/Delete)" as UC_ManageAll
}

' --- Connections ---
Amine --> UC_Browse
Amine --> UC_Filter
Amine --> UC_Read
Amine --> UC_Comment

Sara --> UC_Submit
Sara --> UC_ManageOwn

Ayoub --> UC_ManageAll

' --- Relationships ---
UC_Filter ..> UC_Browse : <<extends>>
UC_Read ..> UC_Browse : <<extends>>
@enduml