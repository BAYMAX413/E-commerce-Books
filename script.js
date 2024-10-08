// Initial Data
const books = [
    {
      id: 1,
      title: "The Great Gatsby",
      author: "F. Scott Fitzgerald",
      price: 12.99,
      image: "/placeholder.svg",
      inStock: true,
    },
    {
      id: 2,
      title: "To Kill a Mockingbird",
      author: "Harper Lee",
      price: 9.99,
      image: "/placeholder.svg",
      inStock: true,
    },
    {
      id: 3,
      title: "1984",
      author: "George Orwell",
      price: 8.99,
      image: "/placeholder.svg",
      inStock: false,
    },
    {
      id: 4,
      title: "Pride and Prejudice",
      author: "Jane Austen",
      price: 11.99,
      image: "/placeholder.svg",
      inStock: true,
    },
    {
      id: 5,
      title: "The Catcher in the Rye",
      author: "J.D. Salinger",
      price: 10.99,
      image: "/placeholder.svg",
      inStock: true,
    },
  ];
  
  let cart = [];
  
  // Function to render books
  function renderBooks() {
    const bookList = document.getElementById('book-list');
    bookList.innerHTML = ''; // Clear previous content
  
    books.forEach(book => {
      const bookCard = document.createElement('div');
      bookCard.className = 'book-card';
  
      bookCard.innerHTML = `
        <img src="${book.image}" alt="${book.title}">
        <div class="details">
          <h3>${book.title}</h3>
          <p>${book.author}</p>
          <div class="flex justify-between items-center">
            <span class="price">$${book.price.toFixed(2)}</span>
            <button ${!book.inStock ? 'disabled' : ''} onclick="addToCart(${book.id})">Add to Cart</button>
          </div>
        </div>
      `;
  
      if (!book.inStock) {
        const outOfStockBadge = document.createElement('div');
        outOfStockBadge.className = 'out-of-stock-badge';
        outOfStockBadge.textContent = 'Out of Stock';
        bookCard.appendChild(outOfStockBadge);
      }
  
      bookList.appendChild(bookCard);
    });
  }
  
  // Function to add a book to the cart
  function addToCart(bookId) {
    const book = books.find(b => b.id === bookId);
    cart.push(book);
    renderCart();
  }
  
  // Function to remove a book from the cart
  function removeFromCart(bookId) {
    cart = cart.filter(book => book.id !== bookId);
    renderCart();
  }
  
  // Function to render the cart
  function renderCart() {
    const cartSection = document.getElementById('cart');
    cartSection.innerHTML = ''; // Clear previous content
  
    if (cart.length === 0) {
      cartSection.innerHTML = '<p>Your cart is empty.</p>';
      return;
    }
  
    cart.forEach(book => {
      const cartItem = document.createElement('div');
      cartItem.className = 'cart-item';
  
      cartItem.innerHTML = `
        <div class="info">
          <img src="${book.image}" alt="${book.title}">
          <div>
            <h3>${book.title}</h3>
            <p>${book.author}</p>
          </div>
        </div>
        <span class="price">$${book.price.toFixed(2)}</span>
        <button class="remove-btn" onclick="removeFromCart(${book.id})">Remove</button>
      `;
  
      cartSection.appendChild(cartItem);
    });
  }
  
  // Initial render
  renderBooks();
  renderCart();
  