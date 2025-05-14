<footer class="container-fluid">
        <div class="footer-content container">
            <div class="row">
                <div class="footer-section about col-md-6 col-12">
                    <h3 class="logo-text">GROOMMY</h3>
                    <p>
                        Профессиональный уход — это залог
                        безупречного внешнего вида, гарантия долголетия и здоровья питомца!
                    </p>
                    <div class="contact">
                        <span><i class="fas fa-home"></i> &nbsp; ул. Карла Маркса 174</span>
                        <span><i class="fas fa-phone"></i> &nbsp; 8 123-456-789</span>
                        <span><i class="fas fa-envelope"></i> &nbsp; pet@groommy.com</span>
                    </div>
                    <div class="socials">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>
                <div class="footer-section contact-form col-md-4 col-12">
                    <h3>Связаться с нами</h3>
                    <br>
                    <form action="index.html" method="post">
                        <input type="email" name="email" class="text-input contact-input" placeholder="Ваш email...">
                        <textarea rows="4" name="message" class="text-input contact-input"
                            placeholder="Ваше сообщение..."></textarea>
                        <button type="submit" class="btn btn-big contact-btn">
                            <i class="fas fa-envelope"></i>
                            Отправить
                        </button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; grooommy.com | Designed by desulltor
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const appointmentButtons = document.querySelectorAll('a[href="#zap"], .btn-zap');
            const appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'));
            appointmentButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    appointmentModal.show();
                });
            });
            const appointmentForm = document.getElementById('appointmentForm');
            if (appointmentForm) {
                appointmentForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('Заявка отправлена! Мы свяжемся с вами в ближайшее время.');
                    appointmentModal.hide();
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>
</html>