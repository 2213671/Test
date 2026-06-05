package com.example.pos_hcsdl.entity;

import jakarta.persistence.Column;
import jakarta.persistence.Embeddable;
import jakarta.validation.constraints.NotNull;
import jakarta.validation.constraints.Size;
import lombok.Getter;
import lombok.Setter;
import org.hibernate.Hibernate;

import java.io.Serializable;
import java.util.Objects;

@Getter
@Setter
@Embeddable
public class ProductToppingId implements Serializable {
    private static final long serialVersionUID = 8789108450155907545L;
    @Size(max = 36)
    @NotNull
    @Column(name = "product_id", nullable = false, length = 36)
    private String productId;

    @Size(max = 36)
    @NotNull
    @Column(name = "topping_id", nullable = false, length = 36)
    private String toppingId;

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || Hibernate.getClass(this) != Hibernate.getClass(o)) return false;
        ProductToppingId entity = (ProductToppingId) o;
        return Objects.equals(this.productId, entity.productId) &&
                Objects.equals(this.toppingId, entity.toppingId);
    }

    @Override
    public int hashCode() {
        return Objects.hash(productId, toppingId);
    }

}