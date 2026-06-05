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
public class PromotionMenuId implements Serializable {
    private static final long serialVersionUID = 2903227961843921150L;
    @Size(max = 36)
    @NotNull
    @Column(name = "promotion_id", nullable = false, length = 36)
    private String promotionId;

    @Size(max = 36)
    @NotNull
    @Column(name = "menu_id", nullable = false, length = 36)
    private String menuId;

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || Hibernate.getClass(this) != Hibernate.getClass(o)) return false;
        PromotionMenuId entity = (PromotionMenuId) o;
        return Objects.equals(this.menuId, entity.menuId) &&
                Objects.equals(this.promotionId, entity.promotionId);
    }

    @Override
    public int hashCode() {
        return Objects.hash(menuId, promotionId);
    }

}