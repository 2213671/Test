package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.Shift;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.util.Optional;

public interface ShiftRepository extends JpaRepository<Shift, String> {

    @Query(value = "select * from shifts where closer_id is null and close_at is null and restaurant_id = :restaurant_id", nativeQuery = true)
    Optional<Shift> findCurrentShift(@Param("restaurant_id") String restaurantId);

    @Query(value =
            "SELECT * FROM shifts " +
                    "WHERE restaurant_id = :restaurant_id " +
                    "ORDER BY " +
                    "  CASE WHEN closer_id IS NULL AND close_at IS NULL THEN 0 ELSE 1 END, " + // chưa đóng lên trước
                    "  close_at DESC " +  // nếu đã đóng, lấy mới nhất
                    "LIMIT 1",
            nativeQuery = true)
    Optional<Shift> findCurrentOrLastShift(@Param("restaurant_id") String restaurantId);

}
