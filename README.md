# JamilX Framework

JamilX is a high-performance, zero-dependency PHP MVC framework engineered for building modular SaaS ecosystems. It prioritizes system integrity and extreme performance by abstracting core logic into a proprietary "Service-Action" routing architecture.

## 🏗 Core Architecture: The JamilX Pattern

JamilX evolves the traditional MVC pattern into a more rigid, scalable structure:

| Component | JamilX Equivalent | Base Class / Interface | Location |
| :--- | :--- | :--- | :--- |
| **Model** | **Prototype** | `JX_Prototype` / `JX_PrototypeI` | `/prototypes` |
| **View** | **Container** | Standardized Output | `/containers` |
| **Controller (App)** | **Service** | `JX_Service` / `JXI_Service` | `/services` |
| **Controller (Sub)** | **Action** | `JX_Action` / `JXI_Action` | `/actions` |

### Automatic Routing
JamilX eliminates manual route configuration. Routing is derived from the filesystem:
- `/email` -> Triggers `EmailService`
- `/email/inbox` -> Triggers `InboxAction` within the Email Service.

## 🚀 Strategic Advantages
- **Zero Dependencies:** No vendor bloat. Total control over the execution lifecycle.
- **Extreme Performance:** Optimized for low-latency SaaS environments.
- **Atomic Scaling:** Add new "Apps" (Services) simply by extending base classes in the `scripts/` directory.

## 🛠 Installation & Requirements
- **PHP Version:** 7.0+
- **Setup:** 1. Clone the repository to your server.
  2. Navigate to `/install` in your browser.
  3. Follow the automated setup prompt.

## ⚖ Governance & Contribution
To maintain the integrity of the JamilX ecosystem and ensure seamless updates:
1. **The Scripts Rule:** All application-specific logic must reside within the `/scripts` folder.
2. **Core Preservation:** Never alter base classes or interfaces. This prevents update conflicts and maintains system stability.
3. **Inheritance:** Every new module must implement its respective `JXI` interface to ensure type-safety and system compatibility.