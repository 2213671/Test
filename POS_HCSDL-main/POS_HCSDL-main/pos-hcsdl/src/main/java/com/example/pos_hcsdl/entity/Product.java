        package com.example.pos_hcsdl.entity;

        import jakarta.persistence.*;
        import jakarta.validation.constraints.NotNull;
        import jakarta.validation.constraints.Size;
        import lombok.Getter;
        import lombok.Setter;
        import org.hibernate.annotations.ColumnDefault;

        import java.math.BigDecimal;
        import java.time.Instant;

        @Getter
        @Setter
        @Entity
        @Table(name = "products")
        public class Product extends BaseEntity {
            @Id
            @Size(max = 36)
            @GeneratedValue(strategy = GenerationType.UUID)
            @Column(name = "id", nullable = false, length = 36)
            private String id;

            @Size(max = 500)
            @NotNull
            @Column(name = "name", nullable = false, length = 500)
            private String name;

            @Size(max = 500)
            @Column(name = "description", length = 500)
            private String description;

            @Size(max = 500)
            @Column(name = "tag", length = 500)
            private String tag;

            @Size(max = 500)
            @Column(name = "image_url", length = 500)
            private String imageUrl;

            @Size(max = 20)
            @NotNull
            @Column(name = "status", nullable = false, length = 20)
            private String status;

            @NotNull
            @Column(name = "price", nullable = false, precision = 20, scale = 4)
            private BigDecimal price;

            @NotNull
            @ManyToOne(fetch = FetchType.LAZY, optional = false)
            @JoinColumn(name = "restaurant_id", nullable = false)
            private Restaurant restaurant;

            @ManyToOne(fetch = FetchType.LAZY)
            @JoinColumn(name = "menu_id")
            private Menu menu;


        }