import React, { useState } from "react";
import { assets } from "../assets/assets";
import toast from "react-hot-toast";

const Contact = () => {
    const [formData, setFormData] = useState({
        name: "",
        email: "",
        subject: "",
        message: "",
    });

    const [loading, setLoading] = useState(false);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData((prev) => ({
            ...prev,
            [name]: value,
        }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (!formData.name || !formData.email || !formData.subject || !formData.message) {
            toast.error("Please fill in all fields");
            return;
        }

        setLoading(true);

        // Simulate sending email (in production, this would call an API)
        setTimeout(() => {
            toast.success("Message sent successfully! We'll get back to you soon.");
            setFormData({
                name: "",
                email: "",
                subject: "",
                message: "",
            });
            setLoading(false);
        }, 1500);
    };

    return (
        <div className="mt-10">
            {/* Page Header */}
            <div className="flex flex-col items-start gap-4 mb-12">
                <h1 className="text-4xl md:text-5xl font-semibold text-gray-800">
                    Get In Touch
                </h1>
                <p className="text-gray-600 text-lg max-w-2xl">
                    Have questions or feedback? We'd love to hear from you. Reach out to us and we'll respond as soon as possible.
                </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
                {/* Contact Information */}
                <div className="space-y-8">
                    <div className="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                        <h2 className="text-2xl font-semibold text-gray-800 mb-8">
                            Contact Information
                        </h2>

                        {/* Address */}
                        <div className="flex gap-4 mb-8">
                            <div className="flex-shrink-0">
                                <img
                                    src={assets.delivery_truck_icon}
                                    alt="address"
                                    className="w-8 h-8"
                                />
                            </div>
                            <div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Address
                                </h3>
                                <p className="text-gray-600 leading-relaxed">
                                    123 Grocery Lane<br />
                                    Fresh Market Plaza<br />
                                    New Delhi, India 110001
                                </p>
                            </div>
                        </div>

                        {/* Email */}
                        <div className="flex gap-4 mb-8">
                            <div className="flex-shrink-0">
                                <img
                                    src={assets.cart_icon}
                                    alt="email"
                                    className="w-8 h-8"
                                />
                            </div>
                            <div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Email
                                </h3>
                                <p className="text-gray-600">
                                    <a href="mailto:support@greencart.com" className="hover:text-primary transition">
                                        support@greencart.com
                                    </a>
                                </p>
                                <p className="text-gray-600">
                                    <a href="mailto:info@greencart.com" className="hover:text-primary transition">
                                        info@greencart.com
                                    </a>
                                </p>
                            </div>
                        </div>

                        {/* Phone */}
                        <div className="flex gap-4">
                            <div className="flex-shrink-0">
                                <img
                                    src={assets.leaf_icon}
                                    alt="phone"
                                    className="w-8 h-8"
                                />
                            </div>
                            <div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Phone
                                </h3>
                                <p className="text-gray-600">
                                    <a href="tel:+919876543210" className="hover:text-primary transition">
                                        +91 98765 43210
                                    </a>
                                </p>
                                <p className="text-gray-600 text-sm mt-2">
                                    Available Monday - Friday, 9 AM - 6 PM IST
                                </p>
                            </div>
                        </div>
                    </div>

                    {/* Follow Us */}
                    <div className="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                        <h3 className="text-xl font-semibold text-gray-800 mb-6">
                            Follow Us
                        </h3>
                        <div className="flex gap-4">
                            <a
                                href="#"
                                className="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center hover:bg-primary/20 transition"
                                title="Facebook"
                            >
                                <span className="text-primary font-bold">f</span>
                            </a>
                            <a
                                href="#"
                                className="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center hover:bg-primary/20 transition"
                                title="Twitter"
                            >
                                <span className="text-primary font-bold">𝕏</span>
                            </a>
                            <a
                                href="#"
                                className="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center hover:bg-primary/20 transition"
                                title="Instagram"
                            >
                                <span className="text-primary font-bold">📷</span>
                            </a>
                            <a
                                href="#"
                                className="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center hover:bg-primary/20 transition"
                                title="LinkedIn"
                            >
                                <span className="text-primary font-bold">in</span>
                            </a>
                        </div>
                    </div>
                </div>

                {/* Contact Form */}
                <div className="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                    <h2 className="text-2xl font-semibold text-gray-800 mb-8">
                        Send us a Message
                    </h2>

                    <form onSubmit={handleSubmit} className="space-y-6">
                        {/* Name */}
                        <div className="flex flex-col gap-2">
                            <label className="text-sm font-medium text-gray-700">
                                Full Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                value={formData.name}
                                onChange={handleChange}
                                placeholder="Your name"
                                className="outline-none px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition"
                            />
                        </div>

                        {/* Email */}
                        <div className="flex flex-col gap-2">
                            <label className="text-sm font-medium text-gray-700">
                                Email Address
                            </label>
                            <input
                                type="email"
                                name="email"
                                value={formData.email}
                                onChange={handleChange}
                                placeholder="your@email.com"
                                className="outline-none px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition"
                            />
                        </div>

                        {/* Subject */}
                        <div className="flex flex-col gap-2">
                            <label className="text-sm font-medium text-gray-700">
                                Subject
                            </label>
                            <input
                                type="text"
                                name="subject"
                                value={formData.subject}
                                onChange={handleChange}
                                placeholder="What is this about?"
                                className="outline-none px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition"
                            />
                        </div>

                        {/* Message */}
                        <div className="flex flex-col gap-2">
                            <label className="text-sm font-medium text-gray-700">
                                Message
                            </label>
                            <textarea
                                name="message"
                                value={formData.message}
                                onChange={handleChange}
                                placeholder="Tell us what you think..."
                                rows="5"
                                className="outline-none px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition resize-none"
                            ></textarea>
                        </div>

                        {/* Submit Button */}
                        <button
                            type="submit"
                            disabled={loading}
                            className={`w-full py-3 px-6 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition ${
                                loading ? "opacity-50 cursor-not-allowed" : ""
                            }`}
                        >
                            {loading ? "Sending..." : "Send Message"}
                        </button>
                    </form>
                </div>
            </div>

            {/* FAQ Section */}
            <div className="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] mb-12">
                <h2 className="text-2xl font-semibold text-gray-800 mb-8">
                    Frequently Asked Questions
                </h2>

                <div className="space-y-6">
                    {[
                        {
                            question: "What are your delivery times?",
                            answer:
                                "We offer fast delivery within 30 minutes in selected areas. Standard delivery takes 1-2 business days. Delivery times may vary based on location and product availability.",
                        },
                        {
                            question: "How can I track my order?",
                            answer:
                                "Once your order is confirmed, you'll receive a tracking link via email. You can also check the status in your 'My Orders' section on our website.",
                        },
                        {
                            question: "What is your return policy?",
                            answer:
                                "We accept returns within 7 days of delivery for fresh produce. Please ensure the products are unopened and in original condition. Contact us with your order ID to initiate a return.",
                        },
                        {
                            question: "Do you deliver on weekends and holidays?",
                            answer:
                                "Yes, we deliver 7 days a week including weekends. However, delivery on certain holidays may be limited. Check our app for availability in your area.",
                        },
                    ].map((faq, index) => (
                        <div
                            key={index}
                            className="border-l-4 border-primary/30 pl-6 py-4"
                        >
                            <h3 className="font-semibold text-gray-800 mb-2">
                                {faq.question}
                            </h3>
                            <p className="text-gray-600 leading-relaxed">
                                {faq.answer}
                            </p>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default Contact;
